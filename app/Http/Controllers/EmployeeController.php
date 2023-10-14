<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\EmploymentDivision;
use App\Models\EmploymentRole;
use App\Models\EmploymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Adjust the namespace as needed

class EmployeeController extends Controller
{
    public function index()
    {
        $employments = Employment::latest()->paginate(5);
        return view('employee.index', compact('employments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Employment $employment)
    {
        return view('employee.detail', compact('employment'));
    }

    public function create()
    {
        $employmentStatuses = EmploymentStatus::all();
        $employmentRoles = EmploymentRole::all();
        $employmentDivisions = EmploymentDivision::all();

        return view('employee.create', compact(['employmentStatuses', 'employmentRoles', 'employmentDivisions']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'employment_status' => 'required',
            'employment_division' => 'required',
            'employment_role' => 'required',
        ]);
        if (!File::exists(public_path('images/employment'))) {
            File::makeDirectory(public_path('images/employment'), $mode = 0777, true, true);
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/employment'), $imageName);
        }

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
            'image_path' => $imageName
        ];

        Employment::create($data);

        return redirect()->route('employee.index')->with('success', 'Employee added successfully');
    }

    public function edit()
    {
        $employmentStatuses = EmploymentStatus::all();
        $employmentRoles = EmploymentRole::all();
        $employmentDivisions = EmploymentDivision::all();

        $employeeNik = Route::current()->parameter('employee');

        $employment = Employment::where('nik', $employeeNik)->first();

        return view('employee.edit', compact(['employment','employmentStatuses', 'employmentRoles', 'employmentDivisions']));
    }

    public function update(Request $request, Employment $employment)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $employment->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Employee updated successfully');

    }

    public function destroy(Employment $employment)
    {
        $employment->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully');
    }

}
