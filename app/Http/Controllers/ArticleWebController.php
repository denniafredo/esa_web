<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ArticleWebController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $data = Article::all();
        return view('article.index', compact(['data', 'locale']));
    }

    public function show($id)
    {
        $locale = App::getLocale();
        $data = Article::where('id', $id)->first();
        return view('article.show', compact(['data', 'locale']));
    }

    public function store(Request $request)
    {

    }

    public function create()
    {
        return view('admin.article.create');
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
