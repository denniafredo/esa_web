<?php

namespace App\Http\Controllers;

use App\Imports\AbsenceImports;
use App\Models\Absence;
use App\Models\Employment;
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

        $absences = $query->paginate(5); // Execute the query and paginate the results

        return view('absence.index', compact('absences', 'date_in'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($employmentNik)
    {
    }

    public function create()
    {
        return view('employee.create', compact(['']));
    }

    public function store(Request $request)
    {
        try {
            $csvFile = $request->file('file');
            if ($csvFile) {
                $csvResource = fopen($csvFile, 'r'); // Open the CSV resource for reading

                if ($csvResource) {
                    fgetcsv($csvResource);
                    while (($row = fgetcsv($csvResource)) !== false) {
                        $col = explode(";", $row[0]);
                        $nik = $col[0];
                        $tanggal = $col[1];
                        $waktu_masuk = $col[2];
                        $waktu_keluar = $col[3];
                        $employment = Employment::where('nik', $nik)->first();
                        if ($employment) {
                            $isAbsenceExist = Absence::where('employment_id', $employment->id)->where('date_in', $tanggal)->first();
                            if (!$isAbsenceExist) {
                                Absence::create(['employment_id' => $employment->id, 'date_in' => $tanggal, 'time_in' => $waktu_masuk, 'time_out' => $waktu_keluar]);
                            }
                        }
                    }

                    fclose($csvResource); // Close the CSV resource
                    return redirect()->route('absence.index')->with('success', 'Data Absensi berhasil diupload');
                }
            }
        } catch (\Exception $exception) {
            return redirect()->route('absence.index')->with('error', 'Data Absensi Gagal diupload ' . $exception->getMessage());
        }
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
