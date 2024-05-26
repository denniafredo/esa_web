<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $data = CompanyProfile::orderBy('urutan')->get();
        return view('admin.company-profile.index', ['data' => $data]);
    }


    public function show($id)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKonten' => 'required',
            'konten' => 'required',
            'contentName' => 'required',
            'content' => 'required',
            'urutan' => 'nullable|integer|min:1',
        ]);
        $data = [
            'namaKonten' => $request->input('namaKonten'),
            'konten' => $request->input('konten'),
            'contentName' => $request->input('contentName'),
            'content' => $request->input('content'),
            'urutan' => $request->input('urutan'),
        ];
        CompanyProfile::create($data);
        return redirect()->route('company-profile.index')->with('success', 'Content Added Successfully');
    }

    public function create()
    {
        return view('admin.company-profile.create');
    }

    public function edit()
    {
        $companyProfileId = Route::current()->parameter('company_profile');
        $data = CompanyProfile::where('id', $companyProfileId)->first();
        return view('admin.company-profile.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $companyProfile = CompanyProfile::where('id', $id)->first();
        $companyProfile->update($request->all());

        return redirect()->route('company-profile.index')->with('success', 'Content Added Successfully');
    }

    public function destroy($id)
    {
        $companyProfile = CompanyProfile::where('id', $id)->first();

        if ($companyProfile) {
            $companyProfile->delete();
            return redirect()->route('company-profile.index')->with('success', 'Content Deleted Successfully');
        } else {
            return redirect()->route('company-profile.index')->with('error', 'Content Not Found');
        }
    }

}
