<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SertifikatExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($sertifikat) {
            $training = $sertifikat->training;

            return [
                'ID' => $sertifikat->id,
                'Nama Penerima' => $sertifikat->nama_penerima,
                'Nama Pelatihan' => $training ? $training->nama_training : '-',
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
        // baris 7 menjadi bold untuk header
        $sheet->getStyle('A7:F7')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set nilai pada sel
                $sheet->setCellValue('A1', 'BARTECH ACADEMY');
                $sheet->setCellValue('A2', 'Jalan Holis, Ruko, Jl. Holis Regency No.B-02, Babakan, Kec. Babakan Ciparay, Kota Bandung, Jawa Barat 40222');
                $sheet->setCellValue('A3', '');
                $sheet->setCellValue('A4', '');
                $sheet->setCellValue('A5', 'Data Peserta Professional Training Program');
                $sheet->setCellValue('A6', '');

                // Merge sel
                $sheet->mergeCells('A1:F1');
                $sheet->mergeCells('A2:F2');
                $sheet->mergeCells('A3:F3');
                $sheet->mergeCells('A4:F4');
                $sheet->mergeCells('A5:F5');
                $sheet->mergeCells('A6:F6');

                // Tambahkan style untuk header
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 30,
                        'color' => ['rgb' => '11318D'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Tambahkan border untuk A3:F3
                $sheet->getStyle('A4:F4')->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                    ],
                ]);

                $sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

            },

        ];
    }
}
