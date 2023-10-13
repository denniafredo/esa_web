<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.view');
    }

    public function show($id)
    {
        return view('employee.detail', ['id' => $id]);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function edit($id)
    {
        return view('employee.edit', ['id' => $id]);
    }

    public function destroy($id)
    {
        return redirect()->route('employee.view');
    }

}
