<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    public function create()
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
        $benefit = Benefit::where('employment_id',$employment->id)->first();
        if(!$benefit){
            $data = [
                'employment_id' => $employment->id,
            ];

            Benefit::create($data);
            $benefit = Benefit::where('employment_id',$employment->id)->first();
        }
        return view('benefit.edit', compact(['employment', 'benefit']));
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
        $benefit = Benefit::where('employment_id',$employment->id)->first();
        if (!$employment) {
            return redirect()->back()
                ->with('error', 'Data benefit tidak ditemukan');
        }
        $benefit->update($request->all());

        return redirect()->back()
            ->with('success', 'Data Benefit berhasil di update');
    }

    public function destroy($employmentNik)
    {
    }
}
