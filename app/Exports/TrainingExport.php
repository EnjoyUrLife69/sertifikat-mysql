<?php

namespace App\Exports;

use App\Models\Training;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TrainingExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Training::withCount('sertifikat')->get()->map(function ($training) {
            return [
                'ID' => $training->id,
                'Nama Training' => $training->nama_training,
                'Tanggal Mulai - Tanggal Selesai' => $this->formatDate($training->tanggal_mulai, $training->tanggal_selesai),
                'Jumlah Partisipasi' => $this->formatParticipationCountForExport($training->sertifikat_count),
                'Kode' => $training->kode,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Training',
            'Tanggal Mulai - Tanggal Selesai',
            'Jumlah Partisipasi',
            'Kode',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Mengambil jumlah baris data untuk diproses
        $rowCount = count($this->collection()) + 1; // +1 untuk baris header

        // Loop melalui setiap baris untuk menentukan styling
        for ($row = 2; $row <= $rowCount; $row++) { // mulai dari 2 karena baris 1 adalah header
            if ($sheet->getCell("D$row")->getValue() === 'Tidak ada Peserta') {
                $sheet->getStyle("D$row")->getFont()->getColor()->setARGB('FF3E1D'); // Warna merah
            }
        }
    }

    // Fungsi untuk format partisipasi tanpa HTML
    private function formatParticipationCountForExport($count)
    {
        if ($count === 0) {
            return 'Tidak ada Peserta'; // Teks biasa untuk tidak ada partisipasi
        }
        return $count . ' Peserta'; // Menambahkan kata "Peserta"
    }

    private function formatDate($startDate, $endDate)
    {
        return Carbon::parse($startDate)->format('d-m-Y') . ' - ' . Carbon::parse($endDate)->format('d-m-Y');
    }
}


