<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::all();
        return view('admin.article.index', compact('data'));
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'namaKonten' => 'required',
                'konten' => 'required',
                'contentName' => 'required',
                'content' => 'required',
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
            ];

            Article::create($data);
            return redirect()->route('article.index')->with('success', 'Article Added Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('article.index')->with('error', 'An error occurred while uploading cover image. Please try again.');
        }
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function edit()
    {
        $articleId = Route::current()->parameter('article');
        $data = Article::where('id', $articleId)->first();
        return view('admin.article.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'namaKonten' => 'required',
                'konten' => 'required',
                'contentName' => 'required',
                'content' => 'required',
            ]);

            $article = Article::findOrFail($id);

            // Prepare data for updating
            $data = $request->only(['namaKonten', 'konten', 'contentName', 'content']);

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
                if ($article->coverImage) {
                    $oldImagePath = public_path($article->coverImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            $article->update($data);

            return redirect()->route('article.index')->with('success', 'Article Updated Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            return redirect()->route('article.index')->with('error', 'An error occurred while updating the article. Please try again.');
        }
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
