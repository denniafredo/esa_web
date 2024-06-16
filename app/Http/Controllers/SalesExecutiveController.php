<?php

namespace App\Http\Controllers;

use App\Models\SalesExecutive;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SalesExecutiveController extends Controller
{
    public function index()
    {
        $data = SalesExecutive::all();
        return view('admin.sales-executive.index', compact('data'));
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
            ];

            SalesExecutive::create($data);
            return redirect()->route('sales-executive.index')->with('success', 'Sales Executive Added Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('sales-executive.index')->with('error', 'An error occurred while adding Sales Executive data. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.sales-executive.create');
    }

    public function edit()
    {
        $id = Route::current()->parameter('sales_executive');
        $data = SalesExecutive::where('id', $id)->first();
        return view('admin.sales-executive.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);

            $salesExecutive = SalesExecutive::findOrFail($id);

            // Prepare data for updating
            $data = $request->only(['name', 'email', 'phone']);

            // Handle file upload if a new cover image is provided

            $salesExecutive->update($data);

            return redirect()->route('sales-executive.index')->with('success', 'Sales Executive Updated Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('sales-executive.index')->with('error', 'An error occurred while updating the Sales Executive Data. Please try again.');
        }
    }


    public function destroy($id)
    {
        try {
            $data = SalesExecutive::findOrFail($id);

            $data->delete();

            return redirect()->route('sales-executive.index')->with('success', 'Sales Executive Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('sales-executive.index')->with('error', 'An error occurred while deleting the Sales Executive Data. Please try again.');
        }
    }


}
