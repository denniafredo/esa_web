<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\EmploymentDivision;
use App\Models\EmploymentRole;
use App\Models\EmploymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

// Adjust the namespace as needed

class DashboardController extends Controller
{
    public function index()
    {
        $employments = Employment::whereDate('date_start_of_work', '>=', Carbon::now()->subWeek())->get();
        return view('dashboard', compact('employments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show($id)
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
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

}
