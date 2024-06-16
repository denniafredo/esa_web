<?php

namespace App\Http\Controllers;

use App\Models\HeadOffice;
use App\Models\SalesExecutive;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $headOffices = HeadOffice::all();
        $salesExecutives = SalesExecutive::all();
        return view('customer.index', compact(['headOffices', 'salesExecutives']));
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
