<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrainingResource;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function index()
    {
        //get all posts
        $training = Training::latest()->paginate(5);

        //return collection of training as a resource
        return new TrainingResource(true, 'List Data training', $training);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_training' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kode' => 'required|string|max:50',
            'konten' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image only if exists
        $cover = $request->file('cover');
        if ($cover) {
            $coverName = time() . '_' . $cover->getClientOriginalName();
            $cover->move(public_path('images/training'), $coverName);
        } else {
            $coverName = null;
        }

        // Get the year from tanggal_mulai and store it in 'tahun'
        $tahun = Carbon::parse($request->tanggal_mulai)->year;

        // Create training record
        $training = Training::create([
            'cover' => $coverName,
            'nama_training' => $request->nama_training,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kode' => $request->kode,
            'konten' => $request->konten,
            'tahun' => $tahun, // Include the 'tahun' field here
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Training Berhasil Ditambahkan!',
            'data' => $training,
        ], 201);
    }

    
    public function show($id)
    {
        //find post by ID
        $training = Training::find($id);

        //return single post as a resource
        return new TrainingResource(true, 'Detail Data Training!', $training);
    }

    public function update(Request $request, $id)
    {
        // Find the existing training record by ID
        $training = Training::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_training' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'kode' => 'required|string|max:50',
            'konten' => 'required|string',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if cover image is uploaded
        if ($request->hasFile('cover')) {
            // Delete the old image if exists
            if ($training->cover) {
                $oldCoverPath = public_path('images/training/' . $training->cover);
                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath); // Delete the old image from public/images/training
                }
            }

            // Upload the new image
            $cover = $request->file('cover');
            $coverName = time() . '_' . $cover->getClientOriginalName(); // Create a unique name for the new image
            $cover->move(public_path('images/training'), $coverName); // Move the image to public/images/training

            // Update cover in the database
            $training->cover = $coverName;
        }

        // Update other training details
        $training->nama_training = $request->nama_training;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;
        $training->konten = $request->konten;
        $training->tahun = Carbon::parse($request->input('tanggal_mulai'))->year;

        // Save the changes to the database
        $training->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data Training Berhasil Diperbarui!',
            'data' => $training,
        ], 200);
    }

    public function destroy($id)
    {

        //find post by ID
        $training = Training::find($id);

        //delete image
        Storage::delete('public/training/' . basename($training->cover));

        //delete training
        $training->delete();

        //return response
        return new trainingResource(true, 'Data training Berhasil Dihapus!', null);
    }

}
