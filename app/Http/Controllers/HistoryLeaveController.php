<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\HistoryLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

// Adjust the namespace as needed

class HistoryLeaveController extends Controller
{
    public function index()
    {
    }

    public function show($employmentId)
    {
        $historyLeaves = HistoryLeave::where('employment_id', $employmentId)->first();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_leave' => 'required',
        ]);

        if (HistoryLeave::where('date_leave', $request->input('date_leave'))->exists()) {
            return redirect()->back()->with('error', 'Tanggal Cuti sudah ada.');
        }
        if (!Employment::where('id', $request->input('employment_id'))->exists()) {
            return redirect()->back()->with('error', 'Data Karyawan Tidak ditemukan.');
        }
        $data = [
            'employment_id' => $request->input('employment_id'),
            'date_leave' => $request->input('date_leave'),
            'reason' => $request->input('reason'),
        ];
        HistoryLeave::create($data);
        return redirect()->back()->with('success', 'Data Cuti berhasil ditambah');
    }

    public function edit()
    {
        $historyLeaveStatuses = historyLeaveStatus::all();
        $historyLeaveRoles = historyLeaveRole::all();
        $historyLeaveDivisions = historyLeaveDivision::all();

        $employeeNik = Route::current()->parameter('employee');
        $historyLeave = HistoryLeave::where('nik', $employeeNik)->first();
        $historyLeave->phone = remove62PhoneNumber($historyLeave->phone);

        return view('employee.edit', compact(['historyLeave', 'historyLeaveStatuses', 'historyLeaveRoles', 'historyLeaveDivisions']));
    }

    public function update(Request $request, $historyLeaveNik)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'historyLeave_status' => 'required',
            'historyLeave_division' => 'required',
            'historyLeave_role' => 'required',
            'leave_quota' => 'required',
        ]);
        $historyLeave = HistoryLeave::where('nik', $historyLeaveNik)->first();

        if (!$historyLeave) {
            return redirect()->route('employee.index')
                ->with('error', 'Data karyawan tidak ditemukan');
        }

        if ($request->hasFile('image')) {
            $imageName = saveImage('historyLeave', $request->file('image'));
            // Update the image path in the HistoryLeave record
            $historyLeave->image_path = $imageName;
        }

        $historyLeave->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Data karyawan berhasil di update');

    }

    public function destroy($historyLeaveNik)
    {
        $historyLeave = HistoryLeave::where('nik', $historyLeaveNik)->first();

        if ($historyLeave) {
            $historyLeave->delete();
            return redirect()->route('employee.index')->with('success', 'Data karyawan Berhasil di hapus');
        } else {
            return redirect()->route('employee.index')->with('error', 'Data karyawan tidak ditemukan');
        }
    }

}
