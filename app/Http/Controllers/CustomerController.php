<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\HeadOffice;
use App\Models\SalesExecutive;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();

        $headOffices = HeadOffice::all();
        $salesExecutives = SalesExecutive::all();
        return view('customer.index', compact(['headOffices', 'salesExecutives', 'companyProfiles']));
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
