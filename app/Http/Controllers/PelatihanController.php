<?php
namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Support\Carbon;

class PelatihanController extends Controller
{
    // Funtion untuk nge format tanggal dengan ordinal
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

    public function pelatihan($id)
    {
        // Ambil satu data training berdasarkan ID
        $training = Training::findOrFail($id);

        // Proses format tanggal
        $startDate = Carbon::parse($training->tanggal_mulai);
        $endDate = Carbon::parse($training->tanggal_selesai);

        // Format tanggal dengan suffix ordinal
        $formattedStartDate = $this->formatWithOrdinal($startDate);
        $formattedEndDate = $this->formatWithOrdinal($endDate);

        if ($startDate->format('F Y') === $endDate->format('F Y')) {
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');
            $training->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
        } else {
            // Jika tanggal berada di bulan yang berbeda
            $formattedStartDate = $startDate->format('F j');
            $formattedEndDate = $endDate->format('F j, Y');
            $training->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
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

        // Kirim data training ke view 'pelatihan'
        return view('pelatihan', compact('training', 'limitTrainingfooter'));
    }
}
