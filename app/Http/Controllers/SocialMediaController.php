<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Exception;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $data = Sosmed::all();
        return view('admin.sosmed.index', compact('data'));
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'link' => 'required',
            ]);

            $coverImage = $request->file('image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImagePath = '/storage/sosmed_images/' . $coverImageName;

            $coverImage->move(public_path('storage/sosmed_images'), $coverImageName);

            $data = [
                'image' => $coverImagePath,
                'username' => $request->input('username'),
                'link' => $request->input('link'),
            ];

            Sosmed::create($data);
            return redirect()->route('sosmed.index')->with('success', 'Social Media Added Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('sosmed.index')->with('error', 'An error occurred while uploading image. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.sosmed.create');
    }

    public function edit()
    {
        $data = Sosmed::all();
        return view('admin.sosmed.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        try {
            $sosmed = Sosmed::findOrFail($id);

            // Optionally, delete the cover image file if it exists
            if ($sosmed->coverImage) {
                $coverImagePath = public_path($sosmed->coverImage);
                if (file_exists($coverImagePath)) {
                    unlink($coverImagePath);
                }
            }

            $sosmed->delete();

            return redirect()->route('sosmed.index')->with('success', 'Social Media Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            Log::error('Error deleting sosmed: ' . $e->getMessage());
            return redirect()->route('sosmed.index')->with('error', 'An error occurred while deleting the Social Media. Please try again.');
        }
    }


}
