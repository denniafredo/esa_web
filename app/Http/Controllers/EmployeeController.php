<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employment;
use App\Models\EmploymentDivision;
use App\Models\EmploymentRole;
use App\Models\EmploymentStatus;
use App\Models\HistoryLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EmployeeController extends Controller
{
    public function index()
    {
        $employments = Employment::all();
        return view('employee.index', compact('employments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($employmentNik)
    {
        $employment = Employment::where('nik', $employmentNik)->first();
        $historyLeaves = HistoryLeave::where('employment_id', $employment->id)->get();
        $absences = Absence::latest()->paginate(5);
        return view('employee.show', compact(['employment', 'historyLeaves', 'absences']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'nik' => 'required',
            'employment_status' => 'required',
            'employment_division' => 'required',
            'employment_role' => 'required',
            'leave_quota' => 'required',
        ]);
        if ($request->input('email') != '') {
            if (Employment::where('email', $request->input('email'))->exists()) {
                return redirect()->route('employee.create')->with('error', 'Email sudah ada.');
            }
        }

        if (Employment::where('nik', $request->input('nik'))->exists()) {
            return redirect()->route('employee.create')->with('error', 'NIK sudah ada.');
        }

        $imageName = saveImage('employment', $request->file('image'));
        $formatedPhoneNumber = $request->input('phone') ? convertPhoneNumber($request->input('phone')) : '';
        $data = [
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'place_of_birth' => $request->input('place_of_birth'),
            'date_of_birth' => $request->input('date_of_birth'),
            'type_of_blood' => $request->input('type_of_blood'),
            'nik' => $request->input('nik'),
            'email' => $request->input('email'),
            'phone' => $formatedPhoneNumber,
            'religion' => $request->input('religion'),
            'country' => $request->input('country'),
            'region' => $request->input('region'),
            'zip_code' => $request->input('zip_code'),
            'address' => $request->input('address'),
            'date_start_of_work' => $request->input('date_start_of_work'),
            'employment_status_id' => $request->input('employment_status'),
            'employment_division_id' => $request->input('employment_division'),
            'employment_role_id' => $request->input('employment_role'),
            'image_path' => $imageName,
            'leave_quota' => $request->input('leave_quota'),
        ];

        Employment::create($data);

        return redirect()->route('employee.index')->with('success', 'Data Karyawan berhasil ditambah');
    }

    public function create()
    {
        $employmentStatuses = EmploymentStatus::all();
        $employmentRoles = EmploymentRole::all();
        $employmentDivisions = EmploymentDivision::all();

        return view('employee.create', compact(['employmentStatuses', 'employmentRoles', 'employmentDivisions']));
    }

    public function edit()
    {
        $employmentStatuses = EmploymentStatus::all();
        $employmentRoles = EmploymentRole::all();
        $employmentDivisions = EmploymentDivision::all();

        $employeeNik = Route::current()->parameter('employee');
        $employment = Employment::where('nik', $employeeNik)->first();
        $employment->phone = remove62PhoneNumber($employment->phone);
        return view('employee.edit', compact(['employment', 'employmentStatuses', 'employmentRoles', 'employmentDivisions']));
    }

    public function update(Request $request, $employmentNik)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'nik' => 'required',
            'employment_status' => 'required',
            'employment_division' => 'required',
            'employment_role' => 'required',
            'leave_quota' => 'required',
        ]);
        $employment = Employment::where('nik', $employmentNik)->first();

        if (!$employment) {
            return redirect()->route('employee.index')
                ->with('error', 'Data karyawan tidak ditemukan');
        }
        if ($request->input('email') != '') {
            if (Employment::where('email', $request->input('email'))->where('nik', '!=', $request->input('nik'))->exists()) {
                return redirect()->route('employee.create')->with('error', 'Email sudah ada.');
            }
        }
        if ($request->hasFile('image')) {
            $imageName = saveImage('employment', $request->file('image'));
            $employment->image_path = $imageName;
        }

        $employment->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Data karyawan berhasil di update');
    }

    public function destroy($employmentNik)
    {
        $employment = Employment::where('nik', $employmentNik)->first();

        if ($employment) {
            $employment->delete();
            return redirect()->route('employee.index')->with('success', 'Data karyawan Berhasil di hapus');
        } else {
            return redirect()->route('employee.index')->with('error', 'Data karyawan tidak ditemukan');
        }
    }
}
