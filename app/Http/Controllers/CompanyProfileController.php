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
        $coverImage = $request->file('coverImage');
        $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
        $coverImagePath = '/storage/cover_images/' . $coverImageName; // Assuming you want to article images in /storage/cover_images folder
        $coverImage->move(public_path('storage/cover_images'), $coverImageName);

        $data = [
            'coverImage' => $coverImagePath,
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
        $request->validate([
            'namaKonten' => 'required',
            'konten' => 'required',
            'contentName' => 'required',
            'content' => 'required',
        ]);
        $companyProfile = CompanyProfile::findOrFail($id);

        // Prepare data for updating
        $data = $request->only(['namaKonten', 'konten', 'contentName', 'content', 'urutan']);

        // Handle file upload if a new cover image is provided
        if ($request->file('coverImage')) {
            $coverImage = $request->file('coverImage');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImagePath = '/storage/cover_images/' . $coverImageName; // Assuming you want to article images in /storage/cover_images folder

            // Move the new file to the desired location
            $coverImage->move(public_path('storage/cover_images'), $coverImageName);

            // Add the new cover image path to the data array
            $data['coverImage'] = $coverImagePath;

            // Optionally, delete the old cover image file if it exists
            if ($companyProfile->coverImage) {
                $oldImagePath = public_path($companyProfile->coverImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $companyProfile->update($data);

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
