<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Employment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class BenefitController extends Controller
{
    public function index()
    {
        $employments = Employment::all();
        return view('benefit.index', compact('employments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($employmentNik)
    {
    }

    public function store(Request $request)
    {
    }

    public function edit()
    {
        $employeeNik = Route::current()->parameter('benefit');
        $month = request()->query('month');
        $employment = Employment::where('nik', $employeeNik)->first();
        if (!$employment) {
            return redirect()->route('benefit.index')->with('error', 'Data karyawan tidak ditemukan');
        }
        $benefit = Benefit::where('employment_id', $employment->id)->where('periode', $month)->first();
        if (!$benefit) {
            $data = [
                'employment_id' => $employment->id,
                'periode' => $month
            ];

            Benefit::create($data);
            $benefit = Benefit::where('employment_id', $employment->id)->where('periode', $month)->first();
        }
        return view('benefit.edit', compact(['employment', 'benefit']));
    }

    public function create()
    {
    }

    public function update(Request $request, $employmentNik)
    {
        $request->validate([
            'basic_salary' => 'required',
        ]);
        $employment = Employment::where('nik', $employmentNik)->first();
        if (!$employment) {
            return redirect()->back()
                ->with('error', 'Data karyawan tidak ditemukan');
        }
        $benefit = Benefit::where('employment_id', $employment->id)->first();
        if (!$employment) {
            return redirect()->back()
                ->with('error', 'Data benefit tidak ditemukan');
        }

        $request['basic_salary'] = str_replace(',', '', $request['basic_salary']);
        $request['fixed_allowances'] = str_replace(',', '', $request['fixed_allowances']);
        $request['meal_allowances'] = str_replace(',', '', $request['meal_allowances']);
        $request['transport_allowances'] = str_replace(',', '', $request['transport_allowances']);
        $request['overtime_allowances'] = str_replace(',', '', $request['overtime_allowances']);
        $request['performance_allowances'] = str_replace(',', '', $request['performance_allowances']);
        $request['burden'] = str_replace(',', '', $request['burden']);
        $request['potongan_pph_21'] = str_replace(',', '', $request['potongan_pph_21']);
        $request['leave_rights'] = str_replace(',', '', $request['leave_rights']);
        $benefit->update($request->all());

        return redirect()->back()
            ->with('success', 'Data Benefit berhasil di update');
    }

    public function destroy($employmentNik)
    {
    }

    public function export(Request $request, $nik)
    {
        ini_set('max_execution_time', 300); // 5 minutes
        $employee = Employment::where('nik', $nik)->first();
        $periode = $request->input('periode');
        if ($employee) {
            $format = $request->input('format');
            $filename = 'benefit_' . $employee->name . '_' . date(now());
            $benefit = Benefit::where('employment_id', $employee->id)->where('periode', $periode)->first();
            if ($format == 'pdf') {
//                return view('pdf.benefit', compact('benefit'));
                $pdf = PDF::loadView('pdf.benefit', compact('benefit'));
                return $pdf->download($filename . '.pdf');
            } else if ($format == 'excel') {
                return Self::exportToExcel($benefit, $filename);
            }
        } else {
            return redirect()->route('employee.index')->with('error', 'Employee not found.');
        }
    }

    public function exportToExcel($benefit, $filename)
    {
        $hariKerja = $benefit->day_of_works;

        $gajiPokok = $benefit->basic_salary;
        $makan = $benefit->meal_allowances;
        $transport = $benefit->transport_allowances;
        $kinerja = $benefit->performance_allowances;

        $persenBPJSPPH = $benefit->persenpph;

        $transportPerBulan = intval($transport) * intval($hariKerja);
        $makanPerBulan = intval($makan) * intval($hariKerja);

        $BPJSKesehatanPendapatan = intval($gajiPokok) * 0.04;
        $BPJSJHTPendapatan = intval($gajiPokok) * 0.037;
        $BPJSJKKPendapatan = intval($gajiPokok) * 0.0054;
        $BPJSJKMPendapatan = intval($gajiPokok) * 0.003;
        $BPJSPensiunPendapatan = intval($gajiPokok) * 0.02;
        $totalBPJKTK = $BPJSJHTPendapatan + $BPJSJKKPendapatan + $BPJSJKMPendapatan + $BPJSPensiunPendapatan;
        $totalPendapatan = intval($gajiPokok) + intval($kinerja) + intval($transportPerBulan) + intval($makanPerBulan) +
            intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan);

        $leaves = intval($benefit->leaves);
        $sick_leaves = intval($benefit->sick_leaves);
        $absence_leaves = intval($benefit->absence_leaves);
        $totalHariMasuk = intval($hariKerja) - intval($leaves) - intval($sick_leaves) - intval($absence_leaves);

        $pot_absensi = floor((intval($absence_leaves) / intval($hariKerja)) * (intval($gajiPokok) + intval($kinerja)));
        $pot_transport = floor((intval($leaves) + intval($sick_leaves) + intval($absence_leaves)) / intval($hariKerja) * intval($transportPerBulan));
        $pot_makan = floor((intval($leaves) + intval($sick_leaves) + intval($absence_leaves)) / intval($hariKerja) * intval($makanPerBulan));
        $pot_bpjs_kes = floor(0.01 * intval($gajiPokok));
        $pot_bpjs_tk = floor(0.03 * intval($gajiPokok));

        $burden = $benefit->burden;
        $potongan_pph_21 = $benefit->potongan_pph_21;

        $sub_bpjs_kes = $BPJSKesehatanPendapatan;
        $sub_bpjs_tk = intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan);
        $totalPotongan = intval($pot_absensi) + intval($pot_transport) + intval($pot_makan) + intval($burden) + intval($pot_bpjs_kes) + intval($pot_bpjs_tk) +
            intval($BPJSKesehatanPendapatan) + intval($BPJSJHTPendapatan) + intval($BPJSJKKPendapatan) + intval($BPJSJKMPendapatan) + intval($BPJSPensiunPendapatan)
            + intval($potongan_pph_21);

        $thp = $totalPendapatan - $totalPotongan;

        $totalAbsensi = intval($benefit->absence_leaves) + intval($benefit->sick_leaves) + intval($benefit->leaves);
        $sisaCuti = $benefit->leave_rights - $totalAbsensi;

        $spreadsheet = new Spreadsheet();

        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('A1', 'PT ESA SEMARAK ABADI');
        $worksheet->getStyle('A1')->getFont()->setBold(true);
        $worksheet->setCellValue('A2', 'Jl. Maju Jaya RT 006/007');
        $worksheet->setCellValue('A3', 'Kawasan Industri Bawen, Harjosari, Kab. Semarang');
        $worksheet->setCellValue('K1', 'Periode Gaji');
        $worksheet->setCellValue('L1', Carbon::parse($benefit->periode)->format('M-y'));
        $worksheet->setCellValue('K2', 'Hari Kerja');
        $worksheet->setCellValue('L2', $benefit->day_of_works);
        $worksheet->setCellValue('K3', 'No Rek. BCA');
        $worksheet->setCellValue('L3', $benefit->no_account);

        $worksheet->getStyle('A5:L5')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $worksheet->setCellValue('A5', 'NIK');
        $worksheet->setCellValue('B5', ':');
        $worksheet->setCellValue('C5', $benefit->employment->nik);
        $worksheet->setCellValue('A6', 'NAMA');
        $worksheet->setCellValue('B6', ':');
        $worksheet->setCellValue('C6', $benefit->employment->name);
        $worksheet->setCellValue('G5', 'JABATAN');
        $worksheet->setCellValue('H5', ':');
        $worksheet->setCellValue('I5', $benefit->employment->employmentRole->name . ' (' . $benefit->employment->employmentDivision->name . ')');
        $worksheet->setCellValue('G6', 'TMK');
        $worksheet->setCellValue('H6', ':');
        $worksheet->setCellValue('I6', Carbon::parse($benefit->employment->date_start_of_work)->format('d F Y'));


        $worksheet->getStyle('A8:L8')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $worksheet->setCellValue('A8', 'PENDAPATAN');
        $worksheet->getStyle('A8')->getFont()->setBold(true);
        $worksheet->setCellValue('G8', 'POTONGAN');
        $worksheet->getStyle('G8')->getFont()->setBold(true);
        $worksheet->getStyle('A9:L9')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);

        $worksheet->setCellValue('A9', 'GAJI POKOK');
        $worksheet->setCellValue('B9', ':');
        $worksheet->setCellValue('C9', number_format($benefit->basic_salary, 0, '.', ','));
        $worksheet->setCellValue('A10', 'TUNJANGAN');
        $worksheet->setCellValue('B10', ':');
        $worksheet->setCellValue('A11', '- Kinerja');
        $worksheet->setCellValue('B11', ':');
        $worksheet->setCellValue('C11', number_format($benefit->performance_allowances, 0, '.', ','));
        $worksheet->setCellValue('A12', '- Transport');
        $worksheet->setCellValue('B12', ':');
        $worksheet->setCellValue('C12', number_format($transportPerBulan, 0, '.', ','));
        $worksheet->setCellValue('A13', '- Makan');
        $worksheet->setCellValue('B13', ':');
        $worksheet->setCellValue('C13', number_format($makanPerBulan, 0, '.', ','));
        $worksheet->setCellValue('A14', '- BPJS TK');
        $worksheet->setCellValue('B14', ':');
        $worksheet->setCellValue('C14', number_format($totalBPJKTK, 0, '.', ','));
        $worksheet->setCellValue('A15', '- BPJS Kesehatan');
        $worksheet->setCellValue('B15', ':');
        $worksheet->setCellValue('C15', number_format($BPJSKesehatanPendapatan, 0, '.', ','));

        $worksheet->setCellValue('G9', 'ABSENSI');
        $worksheet->setCellValue('H9', $totalAbsensi);
        $worksheet->setCellValue('I9', 'hari');
        $worksheet->setCellValue('J9', ':');
        $worksheet->setCellValue('K9', 'Rp ' . number_format($pot_absensi, 0, '.', ','));
        $worksheet->setCellValue('G10', 'Potongan Uang Transport');
        $worksheet->setCellValue('J10', ':');
        $worksheet->setCellValue('K10', 'Rp ' . number_format($pot_transport, 0, '.', ','));
        $worksheet->setCellValue('G11', 'Potongan Uang Makan');
        $worksheet->setCellValue('J11', ':');
        $worksheet->setCellValue('K11', 'Rp ' . number_format($pot_makan, 0, '.', ','));
        $worksheet->setCellValue('G12', 'Pinjaman / Tanggungan');
        $worksheet->setCellValue('J12', ':');
        $worksheet->setCellValue('K12', 'Rp ' . number_format($burden, 0, '.', ','));
        $worksheet->setCellValue('G13', 'Potongan BPJS Kesehatan');
        $worksheet->setCellValue('J13', ':');
        $worksheet->setCellValue('K13', 'Rp ' . number_format($pot_bpjs_kes, 0, '.', ','));
        $worksheet->setCellValue('G14', 'Potongan BPJS TK Karyawan');
        $worksheet->setCellValue('J14', ':');
        $worksheet->setCellValue('K14', 'Rp ' . number_format($pot_bpjs_tk, 0, '.', ','));
        $worksheet->setCellValue('G15', 'Subsidi BPJS Kesehatan');
        $worksheet->setCellValue('J15', ':');
        $worksheet->setCellValue('K15', 'Rp ' . number_format($sub_bpjs_kes, 0, '.', ','));
        $worksheet->setCellValue('G16', 'Subsidi BPJS TK');
        $worksheet->setCellValue('J16', ':');
        $worksheet->setCellValue('K16', 'Rp ' . number_format($sub_bpjs_tk, 0, '.', ','));
        $worksheet->setCellValue('G17', 'PPh Pasal 21');
        $worksheet->setCellValue('J17', ':');
        $worksheet->setCellValue('K17', 'Rp ' . number_format($potongan_pph_21, 0, '.', ','));

        $worksheet->setCellValue('A18', 'JUMLAH PENDAPATAN');
        $worksheet->getStyle('A18')->getFont()->setBold(true);
        $worksheet->setCellValue('C18', 'Rp ' . number_format($totalPendapatan, 0, '.', ','));

        $worksheet->setCellValue('G18', 'JUMLAH POTONGAN');
        $worksheet->getStyle('G18')->getFont()->setBold(true);
        $worksheet->setCellValue('K18', 'Rp ' . number_format($totalPotongan, 0, '.', ','));
        $worksheet->getStyle('A18:K18')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $worksheet->getStyle('A19:K19')->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);

        $worksheet->setCellValue('A20', 'Hak Cuti');
        $worksheet->setCellValue('B20', ':');
        $worksheet->setCellValue('C20', $benefit->leave_rights);
        $worksheet->setCellValue('A21', 'Diambil');
        $worksheet->setCellValue('B21', ':');
        $worksheet->setCellValue('C21', $totalAbsensi);
        $worksheet->setCellValue('A22', 'Sisa');
        $worksheet->setCellValue('B22', ':');
        $worksheet->setCellValue('C22', $sisaCuti);

        $worksheet->setCellValue('G20', 'GAJI BERSIH DITERIMA');
        $worksheet->setCellValue('K20', number_format($thp, 0, '.', ','));
        $worksheet->getStyle('G20')->getFont()->setBold(true);

        $worksheet->setCellValue('I21', 'Ungaran, ' . Carbon::now()->format('d F Y'));
        $worksheet->setCellValue('J22', 'HRD');

        $writer = new Xlsx($spreadsheet);

        // Set headers for the download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');

        // Send the file to the browser
        $writer->save('php://output');
        exit;
    }

}
