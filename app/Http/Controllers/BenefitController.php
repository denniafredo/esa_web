<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Employment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class BenefitController extends Controller
{
    public function index()
    {
        $employments = Employment::latest()->paginate(5);
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
        $employment = Employment::where('nik', $employeeNik)->first();
        if (!$employment) {
            return redirect()->route('benefit.index')->with('error', 'Data karyawan tidak ditemukan');
        }
        $benefit = Benefit::where('employment_id', $employment->id)->first();
        if (!$benefit) {
            $data = [
                'employment_id' => $employment->id,
            ];

            Benefit::create($data);
            $benefit = Benefit::where('employment_id', $employment->id)->first();
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

        $benefit->update($request->all());

        return redirect()->back()
            ->with('success', 'Data Benefit berhasil di update');
    }

    public function destroy($employmentNik)
    {
    }

    public function export(Request $request, $nik)
    {
        $employee = Employment::where('nik', $nik)->first();

        if ($employee) {
            $format = $request->input('format');
            $filename = 'benefit_' . $employee->name . '_' . date(now());
            $benefit = Benefit::where('employment_id', $employee->id)->first();

            if ($format == 'pdf') {
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
        $gajiPokok = $benefit->basic_salary;
        $tunjanganTetap = $benefit->fixed_allowances;
        $uangMakan = $benefit->meal_allowances;
        $uangTransport = $benefit->transport_allowances;
        $uangLembur = $benefit->overtime_allowances;
        $persenBPJSKesehatan = 1;
        $persenBPJSJHT = 2;
        $persenBPJSPensiun = 1;
        $persenBPJSPPH = $benefit->persenpph;

// Perform calculations
        $total = $gajiPokok + $tunjanganTetap;
        $total_all = $total + $uangMakan + $uangTransport + $uangLembur;
        $bpjs_kesehatan = $total * ($persenBPJSKesehatan / 100);
        $bpjs_jht = $total * ($persenBPJSJHT / 100);
        $bpjs_pensiun = $total * ($persenBPJSPensiun / 100);
        $pph = $total_all * ($persenBPJSPPH / 100);
        $thp = $total_all - $bpjs_kesehatan - $bpjs_jht - $bpjs_pensiun - $pph;
        $spreadsheet = new Spreadsheet();

        $worksheet = $spreadsheet->getActiveSheet();

        // Set the employee information in the Excel file
        $worksheet->setCellValue('A1', 'Employee Information');
        $worksheet->setCellValue('A2', 'Email:');
        $worksheet->setCellValue('B2', $benefit->employment->email);
        $worksheet->setCellValue('A3', 'NIK:');
        $worksheet->setCellValue('B3', $benefit->employment->nik);
        $worksheet->setCellValue('A4', 'Phone:');
        $worksheet->setCellValue('B4', convertPhoneNumber($benefit->employment->phone));
        $worksheet->setCellValue('A5', 'Address:');
        $worksheet->setCellValue('B5', $benefit->employment->address);

        // Set the Benefit information in the Excel file
        $worksheet->setCellValue('A7', 'Benefit');
        $worksheet->setCellValue('A8', 'GAJI POKOK');
        $worksheet->setCellValue('B8', number_format($benefit->basic_salary, 0, '.', ','));
        $worksheet->setCellValue('A9', 'TUNJANGAN TETAP');
        $worksheet->setCellValue('B9', number_format($benefit->fixed_allowances, 0, '.', ','));
        $worksheet->setCellValue('A10', 'UANG MAKAN');
        $worksheet->setCellValue('B10', number_format($benefit->meal_allowances, 0, '.', ','));
        $worksheet->setCellValue('A11', 'UANG TRANSPORT');
        $worksheet->setCellValue('B11', number_format($benefit->transport_allowances, 0, '.', ','));
        $worksheet->setCellValue('A12', 'UANG LEMBUR');
        $worksheet->setCellValue('B12', number_format($benefit->overtime_allowances, 0, '.', ','));
        $worksheet->setCellValue('A13', 'POTONGAN BPJS KESEHATAN (1%)');
        $worksheet->setCellValue('B13', number_format($bpjs_kesehatan, 0, '.', ','));
        $worksheet->setCellValue('A14', 'POTONGAN BPJS JHT (2%)');
        $worksheet->setCellValue('B14', number_format($bpjs_jht, 0, '.', ','));
        $worksheet->setCellValue('A15', 'POTONGAN BPJS PENSIUN (1%)');
        $worksheet->setCellValue('B15', number_format($bpjs_pensiun, 0, '.', ','));
        $worksheet->setCellValue('A16', 'POTONGAN PPH (' . $benefit->persenpph . '%)');
        $worksheet->setCellValue('B16', number_format($pph, 0, '.', ','));
        $worksheet->setCellValue('A17', 'TAKE HOME PAY');
        $worksheet->setCellValue('B17', number_format($thp, 0, '.', ','));


        // Create an Excel writer
        $writer = new Xlsx($spreadsheet);

        // Set headers for the download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');

        // Send the file to the browser
        $writer->save('php://output');
        exit;
    }

}
