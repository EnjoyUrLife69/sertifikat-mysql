<?php
namespace App\Http\Controllers;

use App\Exports\SertifikatExport;
use App\Models\Sertifikat;
use App\Models\Training;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use setasign\Fpdi\Fpdi;

carbon::setLocale('en');

class SertifikatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sertifikat-list|sertifikat-create|sertifikat-edit|sertifikat-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:sertifikat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sertifikat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sertifikat-delete', ['only' => ['destroy']]);
        $this->middleware('permission:sertifikat-export', ['only' => ['exportExcel', 'exportPDF']]);
    }
    public function index(Request $request)
    {
        // $trainingAvailable = Training::where('tanggal_selesai', '>=', Carbon::now())->get();
        $training = Training::all();
        $id_training = $request->get('id_training');

        if ($id_training) {
            $sertifikat = Sertifikat::where('id_training', $id_training)->get();
        } else {
            $sertifikat = Sertifikat::orderBy('created_at', 'desc')->get();

        }

        // Add formatted date range to each $sertifikat
        foreach ($sertifikat as $data) {
            $startDate = Carbon::parse($data->tanggal_mulai);
            $endDate = Carbon::parse($data->tanggal_selesai);

            // Check if the start and end dates are in the same month
            if ($startDate->format('F Y') === $endDate->format('F Y')) {
                $formattedStartDate = $startDate->format('j');
                $formattedEndDate = $endDate->format('j');
                $formattedMonth = $startDate->translatedFormat('F');
                $formattedYear = $startDate->translatedFormat('Y');

                $data->formatted_tanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate} , {$formattedYear}";
            } else {
                // Different months
                $formattedStartDate = $startDate->format('F j');
                $formattedEndDate = $endDate->format('F j ,Y');

                $data->formatted_tanggal = "{$formattedStartDate} - {$formattedEndDate}";
            }
        }

        return view('sertifikat.index', compact('sertifikat', 'training', 'id_training'));
    }

    public function create()
    {
        $sertifikat = Sertifikat::all();
        $training = Training::where('tanggal_selesai', '>=', Carbon::now())->get();
        return view('sertifikat.create', compact('sertifikat', 'training'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required',
            'email' => 'nullable|email|unique:sertifikats,email',
        ]);

        $sertifikat = new Sertifikat;
        $sertifikat->nama_penerima = $request->nama_penerima;
        $sertifikat->id_training = $request->id_training;
        $sertifikat->email = $request->email;

        $sertifikat->save();

        toast('Data has been submited!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index');

    }

    public function show($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $training = training::all();
        return view('sertifikat.show', compact('sertifikat', 'training'));

    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $training = Training::all();

        return view('sertifikat.edit', compact('sertifikat', 'training'));

    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'id_training' => 'required|exists:trainings,id',
            'email' => 'nullable|email',
            'status' => 'required|boolean',
        ]);

        // Ambil data sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Update data lainnya
        $sertifikat->nama_penerima = $request->input('nama_penerima');
        $sertifikat->id_training = $request->input('id_training');
        $sertifikat->email = $request->input('email');

        // Ambil data training terkait
        $training = $sertifikat->training;

        // Cek apakah status berubah menjadi "Selesai"
        if ($request->input('status') == 1 && $sertifikat->status != 1) {
            // Generate nomor sertifikat
            $tahunPelatihan = $training->tahun;

            // Hitung jumlah peserta yang sudah selesai
            $jumlahPesertaTahunIni = Sertifikat::whereHas('training', function ($query) use ($tahunPelatihan) {
                $query->whereYear('tanggal_mulai', $tahunPelatihan);
            })->where('status', 1)->count();

            $nomorPeserta = sprintf('%03d', $jumlahPesertaTahunIni + 1);

            // Mengubah bulan ke format Romawi
            $bulanRomawi = [
                1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
                7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
            ];
            $bulanRomaji = $bulanRomawi[Carbon::parse($training->tanggal_mulai)->format('n')];

            // Format nomor sertifikat
            $nomorSertifikat = sprintf('%s/%s/%s/%d', $nomorPeserta, $training->kode, $bulanRomaji, $tahunPelatihan);

            // Pastikan nomor sertifikat unik
            while (Sertifikat::where('nomor_sertifikat', $nomorSertifikat)->exists()) {
                $jumlahPesertaTahunIni++;
                $nomorPeserta = sprintf('%03d', $jumlahPesertaTahunIni + 1);
                $nomorSertifikat = sprintf('%s/%s/%s/%d', $nomorPeserta, $training->kode, $bulanRomaji, $tahunPelatihan);
            }

            // Simpan nomor sertifikat ke database
            $sertifikat->nomor_sertifikat = $nomorSertifikat;
        }

        // Simpan status pelatihan
        $sertifikat->status = $request->input('status');

        // Simpan perubahan ke database
        $sertifikat->save();

        toast('Data has been updated!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::FindOrFail($id);
        $sertifikat->delete();

        toast('Data has been Deleted!', 'success')->position('top-end');
        return redirect()->route('sertifikat.index');

    }

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

    public function printCertificate($id)
    {
        // Inisialisasi FPDI dan FPDF
        define('FPDF_FONTPATH', public_path('fonts/'));

        // Ambil data sertifikat dari database berdasarkan ID, termasuk data relasi dengan 'training'
        $sertifikat = Sertifikat::with('training')->findOrFail($id);
        $training = $sertifikat->training;

        // Cek apakah sertifikat sudah memiliki nomor, jika ya gunakan nomor yang sudah ada
        if ($sertifikat->nomor_sertifikat) {
            $nomorSertifikat2 = $sertifikat->nomor_sertifikat; // Nomor yang sudah ada
        } else {
            // Ambil data training terkait
            $training = $sertifikat->training;

            if (!$training) {
                return abort(404, 'Training data not found');
            }

            // Ambil tahun pelatihan dari tabel training
            $tahunPelatihan = $training->tahun; // Ambil langsung dari field 'tahun' di training

            // Hitung jumlah peserta untuk tahun tersebut
            $jumlahPesertaTahunIni = Sertifikat::whereHas('training', function ($query) use ($tahunPelatihan) {
                $query->whereYear('tanggal_mulai', $tahunPelatihan);
            })->count();

            // Format nomor peserta dengan leading zeros (mulai dari 001 setiap tahun)
            $nomorPeserta = sprintf('%03d', $jumlahPesertaTahunIni);

            // Format nomor sertifikat
            $nomorSertifikat2 = sprintf(
                '%s/%s/%s/%d',
                $nomorPeserta, // Nomor peserta dengan leading zeros
                $training->kode, // Kode dari tabel training
                $bulanRomaji, // Bulan dalam format Romawi
                Carbon::parse($training->tanggal_mulai)->year// Tahun
            );

            // Simpan nomor sertifikat ke database
            $sertifikat->nomor_sertifikat = $nomorSertifikat2;
            $sertifikat->save();
        }
        // Format tanggal dengan suffix ordinal
        $startDate = Carbon::parse($training->tanggal_mulai);
        $endDate = Carbon::parse($training->tanggal_selesai);

        // Format tanggal dengan suffix ordinal
        $formattedStartDate = $this->formatWithOrdinal($startDate);
        $formattedEndDate = $this->formatWithOrdinal($endDate);

        // Jika tanggal mulai dan selesai berada di hari yang sama
        if ($startDate->isSameDay($endDate)) {
            // Tampilkan tanggal, bulan, dan tahun
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');
            $formattedTanggal = "{$formattedMonth} {$formattedStartDate}, {$formattedYear}";
        }
        // Jika tanggal mulai dan selesai berada di bulan yang sama
        elseif ($startDate->format('F Y') === $endDate->format('F Y')) {
            // Format tanggal mulai dan selesai dalam bulan yang sama/
            $formattedMonth = $startDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');
            $formattedTanggal = "{$formattedMonth} {$formattedStartDate} - {$formattedEndDate}, {$formattedYear}";
        }
        // Jika tanggal mulai dan selesai berada di bulan yang berbeda tetapi tahun yang sama
        elseif ($startDate->format('Y') === $endDate->format('Y')) {
            // Format bulanawal, tglmulai - bulanakhir, tglakhir, tahun
            $formattedStartMonth = $startDate->translatedFormat('F');
            $formattedEndMonth = $endDate->translatedFormat('F');
            $formattedYear = $startDate->translatedFormat('Y');
            $formattedTanggal = "{$formattedStartMonth} {$formattedStartDate} - {$formattedEndMonth} {$formattedEndDate}, {$formattedYear}";
        } else {
            // Jika tanggal mulai dan selesai berada di tahun yang berbeda
            $formattedStartMonthYear = $startDate->translatedFormat('F Y'); // Bulan dan tahun mulai
            $formattedEndMonthYear = $endDate->translatedFormat('F Y'); // Bulan dan tahun selesai

            // Menampilkan tanggal mulai dan selesai dengan bulan, tanggal, dan tahun
            $formattedTanggal = "{$startDate->translatedFormat('F')} {$formattedStartDate}, {$startDate->translatedFormat('Y')} - {$endDate->translatedFormat('F')} {$formattedEndDate}, {$endDate->translatedFormat('Y')}";
        }

        // Mengubah bulan ke format Romawi
        $bulanRomawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];
        $bulanRomaji = $bulanRomawi[$startDate->format('n')]; // 'n' menghasilkan angka bulan tanpa leading zero

        // Membuat QR Code dengan URL untuk pengecekan sertifikat
        $qrCode = new QrCode(url('/check-certificate?nomor_sertifikat=' . urlencode($nomorSertifikat2)));
        $qrCode->setSize(300); // Set ukuran QR Code
        $writer = new PngWriter();
        $qrCodePath = storage_path("app/public/images/qr_codes/{$sertifikat->id}.png");

        // Menyimpan QR Code ke file
        $writer->write($qrCode)->saveToFile($qrCodePath);

        // Path ke template PDF
        $templatePath = public_path('assets/img/sertifikat/template.pdf');

        if (!file_exists($templatePath)) {
            return abort(404, 'Template PDF not found');
        }

        // Inisialisasi FPDF
        $pdf = new Fpdi();

        // Daftarkan font
        $pdf->AddFont('AlexBrush-Regular', '', 'AlexBrush-Regular.php');

        // Menambahkan halaman dengan orientasi horizontal (landscape)
        $pdf->AddPage('L');

        // Set sumber file
        $pdf->setSourceFile($templatePath);

        // Import halaman pertama dari template PDF
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->Image($qrCodePath, 30, 140, 50, 50); // Menyesuaikan posisi dan ukuran QR Code

        // Nama Penerima
        $pdf->SetFont('AlexBrush-Regular', '', 45);
        $pdf->SetTextColor(0, 0, 0); // Set warna teks ke hitam
        $pdf->SetXY(5, 90);
        $pdf->Cell(0, 10, $sertifikat->nama_penerima, 0, 1, 'C'); // 'C' untuk center alignment

        // Nomor Sertifikat
        $pdf->SetFont('Helvetica', 'B', 15);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(113, 66);
        $pdf->Write(0, 'NO. ' . $sertifikat->nomor_sertifikat); // Tambahkan "NO. " saat mencetak

        // Nama Pelatihan
        $pdf->SetFont('Helvetica', '', 17);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 115);
        $pdf->Cell(0, 10, 'for ' . $sertifikat->training->nama_training_sertifikat, 0, 1, 'C');

        // Tanggal
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(4, 132.5);
        $pdf->Cell(0, 10, 'on ' . $formattedTanggal, 0, 1, 'C');

        // Nama file sesuai dengan nama penerima
        $fileName = "{$sertifikat->nama_penerima}_Sertifikat.pdf";

        // Output PDF
        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"{$fileName}\"");
    }

    public function exportExcel()
    {
        // Mengambil id_training dari request
        $idTraining = request()->get('id_training');

        // Mengambil data sertifikat dengan filter jika id_training diberikan
        if ($idTraining) {
            $data = Sertifikat::with('training')->where('id_training', $idTraining)->orderBy('nama_penerima', 'asc')->get();
        } else {
            $data = Sertifikat::with('training')->get();
        }

        return Excel::download(new SertifikatExport($data), 'sertifikat.xlsx');
    }

    public function exportPDF(Request $request)
    {
        // Ambil parameter id_training dari request
        $idTraining = $request->get('id_training');

        // Ambil data sertifikat berdasarkan id_training yang difilter
        $sertifikat = Sertifikat::with('training')
            ->when($idTraining, function ($query) use ($idTraining) {
                return $query->where('id_training', $idTraining);
            })
            ->orderBy('nama_penerima', 'asc')
            ->get();

        // Cek apakah ada sertifikat yang ditemukan
        if ($sertifikat->isEmpty()) {
            return redirect()->back()->with('error', 'Data sertifikat tidak ditemukan.');
        }

        // Tentukan nama training jika id_training diberikan
        $namaTraining = $idTraining && $sertifikat->first()->training
        ? str_replace(' ', '_', $sertifikat->first()->training->nama_training)
        : 'sertifikat';

        // Siapkan data untuk dikirim ke view
        $data = [
            'sertifikat' => $sertifikat,
        ];

        // Load view untuk PDF
        $pdfView = View::make('pdf.certificate', $data)->render();

        // Inisialisasi DOMPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load HTML dari view ke DOMPDF
        $dompdf->loadHtml($pdfView);

        // (Optional) Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Nama file PDF yang akan didownload
        $namaFile = $namaTraining . '_peserta.pdf';

        // Kirim PDF ke browser untuk didownload
        return $dompdf->stream($namaFile);
    }

}
