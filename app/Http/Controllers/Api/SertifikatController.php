<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SertifikatResource;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = Sertifikat::all();

        //return collection of sertifikat as a resource
        return new SertifikatResource(true, 'List Data sertifikat', $sertifikat);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required|exists:trainings,id', // pastikan id_training valid
            'email' => 'required|email',
            'status' => 'required|boolean',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create sertifikat
        $sertifikat = Sertifikat::create([
            'nama_penerima' => $request->nama_penerima,
            'id_training' => $request->id_training,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Sertifikat Berhasil Ditambahkan!',
            'data' => $sertifikat,
        ], 201);
    }

    public function show($id)
    {
        //find post by ID
        $sertifikat = Sertifikat::find($id);

        //return single post as a resource
        return new SertifikatResource(true, 'Detail Data sertifikat!', $sertifikat);
    }

    public function update(Request $request, $id)
    {
        // Find the existing training record by ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required|exists:trainings,id', // pastikan id_training valid
            'email' => 'required|email',
            'status' => 'required|boolean',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update other training details
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;
        $sertifikat->email = $request->email;
        $sertifikat->status = $request->status;

        // Save the changes to the database
        $sertifikat->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'Data sertifikat Berhasil Diperbarui!',
            'data' => $sertifikat,
        ], 200);
    }

    public function destroy($id)
    {

        //find post by ID
        $sertifikat = Sertifikat::find($id);

        //delete sertifikat
        $sertifikat->delete();

        //return response
        return new SertifikatResource(true, 'Data sertifikat Berhasil Dihapus!', null);
    }

}
