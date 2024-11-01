<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Ambil tahun yang dipilih dari request, atau default ke tahun saat ini
        $selectedYear = $request->input('tahun', date('Y'));

        // Mengambil daftar tahun yang ada pelatihannya
        $availableYears = Training::selectRaw('EXTRACT(YEAR FROM tanggal_mulai) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Mengambil jumlah pelatihan berdasarkan bulan di tahun tertentu
        $trainings = Training::selectRaw('EXTRACT(MONTH FROM tanggal_mulai) as month, COUNT(*) as total')
            ->whereYear('tanggal_mulai', $selectedYear)
            ->groupBy('month')
            ->get();

        // Ambil detail pelatihan (nama dan tanggal mulai) per bulan di tahun tertentu
        $trainingDetails = Training::selectRaw('nama_training, tanggal_mulai, EXTRACT(MONTH FROM tanggal_mulai) as month')
            ->whereYear('tanggal_mulai', $selectedYear)
            ->get()
            ->groupBy('month');

        // Data limit pelatihan terbaru
        $limitTraining = Training::whereYear('tanggal_mulai', $selectedYear)->orderBy('created_at', 'desc')->limit(5)->get();

        // Mengambil semua pelatihan dan sertifikat di tahun tertentu
        $training = Training::whereYear('tanggal_mulai', $selectedYear)->get();
        $sertifikat = Sertifikat::whereHas('training', function ($query) use ($selectedYear) {
            $query->whereYear('tanggal_mulai', $selectedYear);
        })->get();

        // Menghitung total sertifikat, total pelatihan, jumlah yang terdaftar dan selesai di tahun tertentu
        $total_sertifikat = Sertifikat::whereHas('training', function ($query) use ($selectedYear) {
            $query->whereYear('tanggal_mulai', $selectedYear);
        })->count();
        $total_pelatihan = Training::whereYear('tanggal_mulai', $selectedYear)->count();
        $total_terdaftar = Sertifikat::whereHas('training', function ($query) use ($selectedYear) {
            $query->whereYear('tanggal_mulai', $selectedYear);
        })->where('status', '0')->count();
        $total_selesai = Sertifikat::whereHas('training', function ($query) use ($selectedYear) {
            $query->whereYear('tanggal_mulai', $selectedYear);
        })->where('status', '1')->count();

        // Hitung jumlah peserta per pelatihan
        $trainingWithParticipants = $training->map(function ($training) {
            $participantsCount = Sertifikat::where('id_training', $training->id)->count();
            return [
                'nama_training' => $training->nama_training,
                'kode' => $training->kode,
                'jumlah_peserta' => $participantsCount,
            ];
        });

        // Kirimkan data ke view dengan tahun yang ada pelatihannya
        return view('home', compact(
            'trainings',
            'trainingDetails',
            'total_sertifikat',
            'total_pelatihan',
            'training',
            'sertifikat',
            'limitTraining',
            'total_terdaftar',
            'total_selesai',
            'trainingWithParticipants',
            'availableYears', // Kirim availableYears untuk dropdown
            'selectedYear' // Kirim variabel $selectedYear ke view
        ));
    }

}
