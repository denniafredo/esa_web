<?php

namespace App\Http\Controllers;

use App\Models\HeadOffice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HeadOfficeController extends Controller
{
    public function index()
    {
        $data = HeadOffice::all();
        return view('admin.head-office.index', compact('data'));
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

            HeadOffice::create($data);
            return redirect()->route('head-office.index')->with('success', 'Head Office Added Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('head-office.index')->with('error', 'An error occurred while adding Head Office data. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.head-office.create');
    }

    public function edit()
    {
        $id = Route::current()->parameter('head_office');
        $data = HeadOffice::where('id', $id)->first();
        return view('admin.head-office.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
            ]);

            $headOffice = HeadOffice::findOrFail($id);

            // Prepare data for updating
            $data = $request->only(['name', 'email', 'phone']);

            // Handle file upload if a new cover image is provided

            $headOffice->update($data);

            return redirect()->route('head-office.index')->with('success', 'Head Office Updated Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('head-office.index')->with('error', 'An error occurred while updating the Head Office Data. Please try again.');
        }
    }


    public function destroy($id)
    {
        try {
            $data = HeadOffice::findOrFail($id);

            $data->delete();

            return redirect()->route('head-office.index')->with('success', 'Head Office Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('head-office.index')->with('error', 'An error occurred while deleting the Head Office Data. Please try again.');
        }
    }


}
