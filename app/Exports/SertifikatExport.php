<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SertifikatExport implements FromCollection, WithStyles, ShouldAutoSize, WithEvents
{
    protected $data;
    private $isFiltered;

    public function __construct($data)
    {
        $this->data = $data;
        $this->isFiltered = request()->has('id_training'); // Cek apakah data difilter
    }

    public function collection()
    {
        return $this->data
            ->sortBy('nama_penerima') // Mengurutkan berdasarkan Nama Penerima
            ->values() // Reset indeks setelah pengurutan
            ->map(function ($sertifikat, $key) {
                $result = [
                    'No' => $key + 1,
                    'Nama Penerima' => $sertifikat->nama_penerima,
                    'Email' => $sertifikat->email,
                    'Nomor Sertifikat' => $sertifikat->nomor_sertifikat,
                    'Status' => $sertifikat->status ? 'Selesai Pelatihan' : 'Terdaftar',
                ];

                // Sisipkan "Nama Pelatihan" di posisi yang sesuai jika tidak difilter
                if (!$this->isFiltered) {
                    // Tempatkan "Nama Pelatihan" setelah "Nomor Sertifikat"
                    $result = array_merge(
                        array_slice($result, 0, 3), // Ambil kolom sebelum "Nama Pelatihan"
                        ['Nama Pelatihan' => $sertifikat->training ? $sertifikat->training->nama_training : '-'],
                        array_slice($result, 3) // Ambil kolom setelah "Nama Pelatihan"
                    );
                }

                return $result;
            });
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

                // Periksa apakah ada filter id_training
                $namaPelatihan = null;
                if (request()->has('id_training')) {
                    $idTraining = request()->get('id_training');
                    $training = \App\Models\Training::find($idTraining);
                    $namaPelatihan = $training ? $training->nama_training : '-';
                }

                // Tambahkan nama pelatihan jika ada
                if ($namaPelatihan) {
                    $sheet->setCellValue('A6', $namaPelatihan);
                    $sheet->mergeCells('A6:E6');
                    $sheet->getStyle('A6')->applyFromArray([
                        'font' => [
                            'size' => 12,
                            'italic' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                    ]);
                } else {
                    $sheet->setCellValue('A6', '');
                    $sheet->mergeCells('A6:F6');
                }

                $sheet->setCellValue('A7', '');

                // Periksa apakah ada filter
                if ($this->isFiltered) {
                    // Jika ada filter, merge sampai kolom E (A sampai E)
                    $sheet->mergeCells('A1:E1');
                    $sheet->mergeCells('A2:E2');
                    $sheet->mergeCells('A3:E3');
                    $sheet->mergeCells('A4:E4');
                    $sheet->mergeCells('A5:E5');
                    $sheet->mergeCells('A7:E7');
                } else {
                    // Jika tidak ada filter, merge sampai kolom F (A sampai F)
                    $sheet->mergeCells('A1:F1');
                    $sheet->mergeCells('A2:F2');
                    $sheet->mergeCells('A3:F3');
                    $sheet->mergeCells('A4:F4');
                    $sheet->mergeCells('A5:F5');
                    $sheet->mergeCells('A7:F7');
                }

                // Menambahkan style untuk header
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

                if ($this->isFiltered) {
                    $sheet->getStyle('A4:E4')->applyFromArray([
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            ],
                        ],
                    ]);
                } else {
                    $sheet->getStyle('A4:F4')->applyFromArray([
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            ],
                        ],
                    ]);
                }

                $sheet->getStyle('A5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // **Menambahkan Heading pada Baris A8 dan Bold**
                $sheet->setCellValue('A8', 'No');
                $sheet->setCellValue('B8', 'Nama Penerima');
                $sheet->setCellValue('C8', 'Email');

                // Cek apakah data difilter
                if ($this->isFiltered) {
                    // Jika difilter, "Nama Pelatihan" di D8, "Nomor Sertifikat" di E8, dan "Status" di F8
                    $sheet->setCellValue('D8', 'Nomor Sertifikat');
                    $sheet->setCellValue('E8', 'Status');

                    // Set style hanya sampai E8
                    $sheet->getStyle('A8:E8')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 12,
                        ],
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                } else {
                    // Jika tidak difilter, urutan kolom tetap
                    $sheet->setCellValue('D8', 'Nama Pelatihan');
                    $sheet->setCellValue('E8', 'Nomor Sertifikat');
                    $sheet->setCellValue('F8', 'Status');

                    // Set style sampai F8 (termasuk kolom F jika tidak difilter)
                    $sheet->getStyle('A8:F8')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 12,
                        ],
                        'borders' => [
                            'top' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                            'bottom' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);
                }

                // **Memperlebar kolom**
                $sheet->getColumnDimension('A')->setWidth(10); // Lebar kolom A
                $sheet->getColumnDimension('B')->setWidth(30); // Lebar kolom B
                $sheet->getColumnDimension('C')->setWidth(30); // Lebar kolom C
                $sheet->getColumnDimension('D')->setWidth(25); // Lebar kolom D
                $sheet->getColumnDimension('E')->setWidth(25); // Lebar kolom E
                $sheet->getColumnDimension('F')->setWidth(15); // Lebar kolom F (hanya jika tidak difilter)

            },
        ];
    }

}
