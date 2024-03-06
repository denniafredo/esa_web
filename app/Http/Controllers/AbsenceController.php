<?php

namespace App\Http\Controllers;

use App\Imports\AbsenceImports;
use App\Models\Absence;
use App\Models\Employment;
use Exception;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        $date_in = $request->input('date_in'); // Get the 'date_in' parameter from the request

        $query = Absence::latest(); // Start with the base query

        // Check if 'date_in' parameter is provided, and if so, add the filter condition
        if ($date_in) {
            $query->where('date_in', $date_in);
        }

        $absences = $query->get(); // Execute the query and paginate the results

        return view('absence.index', compact('absences', 'date_in'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($employmentNik)
    {
    }

    public function store(Request $request)
    {
        try {
            $csvFile = $request->file('file');
            if ($csvFile) {
                $csvResource = fopen($csvFile, 'r'); // Open the CSV resource for reading

                if ($csvResource) {
                    for ($i = 0; $i < 2; $i++) {
                        fgetcsv($csvResource); // Read and discard the row
                    }
                    $nik = null;
                    $base_tanggal = null;
                    $tanggal = null;
                    $waktu_masuk = null;
                    $waktu_keluar = null;
                    while (($row = fgetcsv($csvResource)) !== false) {
                        $col = explode(";", $row[0]);
                        if (explode(" ", $row[0])[0] == 'From:') {
                            $base_tanggal = explode(" ", $row[0])[1];
                            $base_tanggal = substr($base_tanggal, 0, -2); // Remove the last 3 characters
                        }
                        if ($col[0] == 'Person ID') {
                            $nik = $col[1];
                        }
                        if ($col[0] == 'Date') {
                            $tanggal = $col;
                        }
                        if ($col[0] == 'Check-in1') {
                            $waktu_masuk = $col;
                        }
                        if ($col[0] == 'Check-out1') {
                            $waktu_keluar = $col;
                        }
                        if ($col[0] == 'Summary') {
                            $employment = Employment::where('nik', $nik)->first();
                            if ($employment) {
                                for ($i = 8; $i < sizeof($tanggal); $i++) {
                                    if ($tanggal[$i] != '-' && ($waktu_masuk[$i] != '-' || $waktu_keluar[$i] != '-')) {
                                        $modified_date = $base_tanggal . str_pad($tanggal[$i], 2, '0', STR_PAD_LEFT);
                                        $isAbsenceExist = Absence::where('employment_id', $employment->id)->where('date_in', $modified_date)->first();
                                        if (!$isAbsenceExist) {
                                            $waktu_masuk[$i] = $waktu_masuk[$i] == '-' ? null : $waktu_masuk[$i];
                                            $waktu_keluar[$i] = $waktu_keluar[$i] == '-' ? null : $waktu_keluar[$i];
                                            Absence::create(['employment_id' => $employment->id, 'date_in' => $modified_date, 'time_in' => $waktu_masuk[$i], 'time_out' => $waktu_keluar[$i]]);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    fclose($csvResource); // Close the CSV resource
                    return redirect()->route('absence.index')->with('success', 'Data Absensi berhasil diupload');
                }
            }
        } catch (Exception $exception) {
            return redirect()->route('absence.index')->with('error', 'Data Absensi Gagal diupload ' . $exception->getMessage());
        }
    }

    public function create()
    {
        return view('employee.create', compact(['']));
    }

    public function edit()
    {
    }

    public function update(Request $request, $employmentNik)
    {
    }

    public function destroy($employmentNik)
    {
    }
}
