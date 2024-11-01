<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
    private function formatWithOrdinal($date)
    {
        $day = $date->day;

        // Tentukan suffix
        if ($day % 10 == 1 && $day != 11) {
            $suffix = 'st';
        } elseif ($day % 10 == 2 && $day != 12) {
            $suffix = 'nd';
        } elseif ($day % 10 == 3 && $day != 13) {
            $suffix = 'rd';
        } else {
            $suffix = 'th';
        }

        return $date->format('j') . $suffix;
    }

    public function index()
    {
        $limitTraining = Training::orderBy('created_at', 'desc')->limit(4)->get();
        foreach ($limitTraining as $data) {
            $startTanggal = Carbon::parse($data->tanggal_mulai);
            $endTanggal = Carbon::parse($data->tanggal_selesai);

            // Format dates with ordinal suffix
            $formattedstartTanggal = $this->formatWithOrdinal($startTanggal);
            $formattedendTanggal = $this->formatWithOrdinal($endTanggal);

            if ($startTanggal->format('F Y') === $endTanggal->format('F Y')) {
                $formattedMonth = $startTanggal->translatedFormat('F');
                $formattedYear = $startTanggal->translatedFormat('Y');

                $data->formatted_tanggal_training = "{$formattedMonth} {$formattedstartTanggal} - {$formattedendTanggal} , {$formattedYear}";
            } else {
                // Different months
                $formattedstartTanggal = $startTanggal->format('F j');
                $formattedendTanggal = $endTanggal->format('F j ,Y');

                $data->formatted_tanggal_training = "{$formattedstartTanggal} - {$formattedendTanggal}";
            }
        }

        $limitTrainingfooter = Training::orderBy('created_at', 'desc')->limit(2)->get();
        foreach ($limitTrainingfooter as $data) {
            $startTanggal = Carbon::parse($data->tanggal_mulai);
            $endTanggal = Carbon::parse($data->tanggal_selesai);

            // Format dates with ordinal suffix
            $formattedstartTanggal = $this->formatWithOrdinal($startTanggal);
            $formattedendTanggal = $this->formatWithOrdinal($endTanggal);

            if ($startTanggal->format('F Y') === $endTanggal->format('F Y')) {
                $formattedMonth = $startTanggal->translatedFormat('F');
                $formattedYear = $startTanggal->translatedFormat('Y');

                $data->formatted_tanggal_training = "{$formattedMonth} {$formattedstartTanggal} - {$formattedendTanggal} , {$formattedYear}";
            } else {
                // Different months
                $formattedstartTanggal = $startTanggal->format('F j');
                $formattedendTanggal = $endTanggal->format('F j ,Y');

                $data->formatted_tanggal_training = "{$formattedstartTanggal} - {$formattedendTanggal}";
            }
        }

        return view('welcome', compact('limitTraining', 'limitTrainingfooter'));
    }

    public function checkCertificate(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_sertifikat' => 'required',
        ]);

        // Ambil input nomor sertifikat
        $nomorSertifikatInput = $request->input('nomor_sertifikat');

        // Cek di database apakah sertifikat dengan nomor sertifikat tersebut ada
        $sertifikat = Sertifikat::with('training')->where('nomor_sertifikat', $nomorSertifikatInput)->first();

        $limitTraining = Training::orderBy('created_at', 'desc')->limit(4)->get();
        $limitTrainingfooter = Training::orderBy('created_at', 'desc')->limit(2)->get();

        // Format tanggal untuk $limitTraining dan $limitTrainingfooter
        foreach ($limitTraining as $data) {
            $startTanggal = Carbon::parse($data->tanggal_mulai);
            $endTanggal = Carbon::parse($data->tanggal_selesai);

            // Format tanggal
            $formattedstartTanggal = $this->formatWithOrdinal($startTanggal);
            $formattedendTanggal = $this->formatWithOrdinal($endTanggal);

            if ($startTanggal->format('F Y') === $endTanggal->format('F Y')) {
                $formattedMonth = $startTanggal->translatedFormat('F');
                $formattedYear = $startTanggal->translatedFormat('Y');
                $data->formatted_tanggal_training = "{$formattedMonth} {$formattedstartTanggal} - {$formattedendTanggal}, {$formattedYear}";
            } else {
                $formattedstartTanggal = $startTanggal->format('F j');
                $formattedendTanggal = $endTanggal->format('F j, Y');
                $data->formatted_tanggal_training = "{$formattedstartTanggal} - {$formattedendTanggal}";
            }
        }

        foreach ($limitTrainingfooter as $data) {
            $startTanggal = Carbon::parse($data->tanggal_mulai);
            $endTanggal = Carbon::parse($data->tanggal_selesai);

            // Format tanggal
            $formattedstartTanggal = $this->formatWithOrdinal($startTanggal);
            $formattedendTanggal = $this->formatWithOrdinal($endTanggal);

            if ($startTanggal->format('F Y') === $endTanggal->format('F Y')) {
                $formattedMonth = $startTanggal->translatedFormat('F');
                $formattedYear = $startTanggal->translatedFormat('Y');
                $data->formatted_tanggal_training = "{$formattedMonth} {$formattedstartTanggal} - {$formattedendTanggal}, {$formattedYear}";
            } else {
                $formattedstartTanggal = $startTanggal->format('F j');
                $formattedendTanggal = $endTanggal->format('F j, Y');
                $data->formatted_tanggal_training = "{$formattedstartTanggal} - {$formattedendTanggal}";
            }
        }

        if ($sertifikat) {
            // Sertifikat ditemukan, ambil data training
            $training = $sertifikat->training; // Menggunakan relasi yang sudah didefinisikan

            // Format tanggal untuk sertifikat
            $startDate = Carbon::parse($training->tanggal_mulai);
            $endDate = Carbon::parse($training->tanggal_selesai);

            $formattedStartDate = $this->formatWithOrdinal($startDate);
            $formattedEndDate = $this->formatWithOrdinal($endDate);

            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedMonth = $startDate->translatedFormat('F');
                $formattedYear = $startDate->translatedFormat('Y');
                $formattedTanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
            } else {
                $formattedStartDate = $startDate->format('F j');
                $formattedEndDate = $endDate->format('F j, Y');
                $formattedTanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }

            $message = "
            <table class='table text-start' style='width:700px; font-weight: bold; color: #105233;'>
                <tr>
                    <th>Nomor Sertifikat</th>
                    <th> : </th>
                    <th>{$nomorSertifikatInput}</th>
                </tr>
                <tr>
                    <th>Nama Penerima</th>
                    <th> : </th>
                    <th>{$sertifikat->nama_penerima}</th>
                </tr>
                <tr>
                    <th>Nama Training</th>
                    <th> : </th>
                    <th>{$training->nama_training}</th>
                </tr>
                <tr>
                    <th>Tanggal Pelatihan</th>
                    <th> : </th>
                    <th>{$formattedTanggal}</th>
                </tr>
            </table>
        ";

            return redirect(url('/') . '#result')->with([
                'status' => 'success',
                'message' => $message,
                'limitTraining' => $limitTraining,
                'limitTrainingfooter' => $limitTrainingfooter,
            ]);

        } else {
            // Sertifikat tidak ditemukan
            return redirect(url('/') . '#sertifikat')->with([
                'status' => 'danger',
                'message' => 'Sertifikat tidak ditemukan. Silakan cek kembali.',
                'limitTraining' => $limitTraining,
                'limitTrainingfooter' => $limitTrainingfooter,
            ]);
        }
    }

}
