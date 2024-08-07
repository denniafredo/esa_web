<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use stdClass;

class AboutController extends Controller
{
    public function index()
    {
        $data = About::where('kantor', 'Pusat')->first();
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
    }

    public function edit()
    {
        $data = About::where('kantor', 'Pusat')->first();
        if (is_null($data)) {
            $data = new stdClass();
            $data->nama = '';
            $data->address = '';
            $data->phone = '';
            $data->website = '';
            $data->bizpartLink = '';
        }
        return view('admin.about.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);
            $about = About::where('kantor', 'Pusat')->first();

            $data = $request->only(['nama', 'address', 'phone', 'website', 'bizpartLink']);
            if (is_null($about)) {
                About::create($data);
            } else {
                $about->update($data);
            }

            return redirect()->route('about.edit', 1)->with('success', 'About Info Updated Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('about.edit', 1)->with('error', 'An error occurred while updating the About Info. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Optionally, delete the cover image file if it exists
            if ($article->coverImage) {
                $coverImagePath = public_path($article->coverImage);
                if (file_exists($coverImagePath)) {
                    unlink($coverImagePath);
                }
            }

            // Delete the article
            $article->delete();

            return redirect()->route('article.index')->with('success', 'Article Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            Log::error('Error deleting article: ' . $e->getMessage());
            return redirect()->route('article.index')->with('error', 'An error occurred while deleting the article. Please try again.');
        }
    }


}
