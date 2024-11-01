<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class SertifikatExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($sertifikat) {

            // Ambil data training
            $training = $sertifikat->training;

            // Format nomor sertifikat, hanya jika statusnya "Selesai Pelatihan"
            // $nomorSertifikat = $sertifikat->status ? $this->generateNomorSertifikat($sertifikat, $training) : 'belum tersedia';

            return [
                'ID' => $sertifikat->id,
                'Nama Penerima' => $sertifikat->nama_penerima,
                'Nama Pelatihan' => $training ? $training->nama_training : '-', // Memastikan ada nilai untuk nama pelatihan
                'Email' => $sertifikat->email,
                'Status' => $sertifikat->status ? 'Selesai Pelatihan' : 'Terdaftar',
                'No Sertifikat' => $sertifikat->nomor_sertifikat,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Penerima',
            'Nama Pelatihan',
            'Email',
            'Status',
            'No Sertifikat',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('E2:E' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Loop untuk memberikan warna berdasarkan status
        foreach ($this->data as $index => $sertifikat) {
            $rowIndex = $index + 2; // karena baris pertama adalah header
            if ($sertifikat->status) { // Selesai Pelatihan
                $sheet->getStyle('E' . $rowIndex)->getFont()->getColor()->setARGB('008000'); //hex kode warna hijau
            } else { // Terdaftar
                $sheet->getStyle('E' . $rowIndex)->getFont()->getColor()->setARGB('0000FF'); //hex kode warna biru
            }
        }
    }

    // private function generateNomorSertifikat($sertifikat, $training)
    // {
    //     // Pastikan data training ada
    //     if (!$training) {
    //         return null;
    //     }

    //     // Format tanggal dari data training
    //     $startDate = Carbon::parse($training->tanggal_mulai);
    //     $bulanRomawi = [
    //         1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
    //         7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
    //     ];
    //     $bulanRomaji = $bulanRomawi[$startDate->format('n')];

    //     return sprintf(
    //         'NO. %03d/%s/%s/%d',
    //         $sertifikat->id, // ID Nama Penerima
    //         $training->kode, // Kode dari tabel training
    //         $bulanRomaji, // Bulan dalam format Romawi
    //         $startDate->year// Tahun
    //     );
    // }
}
