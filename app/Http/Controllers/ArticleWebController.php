<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class ArticleWebController extends Controller
{
    public function index(Request $request)
    {
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $currentPage = $request->input('page', 1);
        $perPage = 6;

        // Calculate the offset
        $offset = ($currentPage - 1) * $perPage;

        // Get the paginated data
        $data = Article::offset($offset)->limit($perPage)->get();

        // Get the total count of articles
        $total = Article::count();
        $maxPages = ceil($total / $perPage);

        return view('article.index', compact(['data', 'total', 'maxPages', 'currentPage', 'companyProfiles']));
    }

    public function show($id)
    {
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $data = Article::where('id', $id)->first();
        return view('article.show', compact(['data', 'companyProfiles']));
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
