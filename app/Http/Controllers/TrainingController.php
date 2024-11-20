<?php

namespace App\Http\Controllers;

use App\Exports\TrainingExport;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

// indonesia
Carbon::setLocale('id');

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:training-list|training-create|training-edit|training-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:training-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:training-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:training-delete', ['only' => ['destroy']]);
    }

    // Fungsi untuk nge format tanggal dengan ordinal
    private function formatWithOrdinal($date)
    {
        $day = $date->day;

        // Tentukan suffix
        if ($day % 100 >= 11 && $day % 100 <= 13) {
            $suffix = 'th'; // pengecualian untuk hari ke 11, 12, dan 13
        } elseif ($day % 10 == 1) {
            $suffix = 'st';
        } elseif ($day % 10 == 2) {
            $suffix = 'nd';
        } elseif ($day % 10 == 3) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        return $date->format('j') . $suffix;
    }

    public function index(Request $request)
    {
        // Mengambil tahun dari tanggal_mulai untuk dropdown
        $tahunList = Training::selectRaw("YEAR(tanggal_mulai) as tahun")
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Filter berdasarkan tahun
        $query = Training::query();
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_mulai', $request->tahun);
        }

        // Mendapatkan data training dan mengurutkannya
        $training = $query->withCount('sertifikat')
            ->orderBy('created_at', 'desc')
            ->get();

        // Format tanggal mulai dan selesai untuk setiap data
        foreach ($training as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Format tanggal dengan suffix ordinal
            $formattedStartDate = $this->formatWithOrdinal($startDate);
            $formattedEndDate = $this->formatWithOrdinal($endDate);

            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedMonth = $startDate->translatedFormat('F');
                $formattedYear = $startDate->translatedFormat('Y');
                $data->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
            } else {
                $formattedStartDate = $startDate->translatedFormat('F j');
                $formattedEndDate = $endDate->translatedFormat('F j, Y');
                $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }
        }

        return view('training.index', compact('training', 'tahunList'));
    }

    public function create()
    {
        return view('training.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_training' => 'required|string|max:255|unique:trainings,nama_training',
            'kode' => 'required|string|max:50|unique:trainings,kode',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten' => 'required|string',
        ]);

        $training = new Training;
        $training->nama_training = $request->nama_training;
        $training->nama_training_sertifikat = $request->nama_training_sertifikat;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;
        $training->tahun = Carbon::parse($request->input('tanggal_mulai'))->year;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = uniqid() . '_' . $img->getClientOriginalName(); // Menggunakan uniqid untuk nama file yang unik
            $path = $img->storeAs('images/training', $name, 'public'); // Menyimpan di storage/app/public/images/training
            $training->cover = $path; // Menyimpan path relatif untuk database
        }

        $training->konten = $request->konten;

        $training->save();

        toast('Data has been Created!', 'success')->position('top-end');
        return redirect()->route('training.index');
    }

    public function show($id)
    {
        $training = Training::withCount('sertifikat')
            ->findOrFail($id);

        return view('training.show', compact('training'));

    }

    public function edit($id)
    {
        $training = Training::FindOrFail($id);
        $existingCover = $training->cover;

        return view('training.edit', compact('training', 'existingCover'));

    }
    public function update(Request $request, $id)
    {
        $training = Training::FindOrFail($id);

        $request->validate([
            'nama_training' => 'required|string|max:255|unique:trainings,nama_training,' . $training->id,
            'kode' => 'required|string|max:50|unique:trainings,kode,' . $training->id,
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'konten' => 'required|string',
        ]);

        $training->nama_training = $request->nama_training;
        $training->nama_training_sertifikat = $request->nama_training_sertifikat;
        $training->tanggal_mulai = $request->tanggal_mulai;
        $training->tanggal_selesai = $request->tanggal_selesai;
        $training->kode = $request->kode;
        $training->tahun = Carbon::parse($request->input('tanggal_mulai'))->year;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = uniqid() . '_' . $img->getClientOriginalName(); // Menggunakan uniqid untuk nama file yang unik
            $path = $img->storeAs('images/training', $name, 'public'); // Menyimpan di storage/app/public/images/training
            $training->cover = $path; // Menyimpan path relatif untuk database
        }

        $training->konten = $request->konten;

        $training->save();

        toast('Data has been Updated!', 'success')->position('top-end');
        return redirect()->route('training.index');

    }

    public function destroy($id)
    {
        $training = Training::FindOrFail($id);
        $training->delete();

        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('training.index');

    }

    public function exportExcel()
    {
        return Excel::download(new TrainingExport(), 'training.xlsx'); // Ekspor data ke file Excel
    }

}
