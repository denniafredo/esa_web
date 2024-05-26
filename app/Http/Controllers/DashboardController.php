<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $companyProfile = $companyProfiles[0];
        return view('dashboard.index', compact(['companyProfiles', 'locale', 'companyProfile']));
    }


    public function show($id)
    {
//        dd(Route::is('dashboard'));
        $locale = App::getLocale();
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $companyProfile = CompanyProfile::where('id', $id)->first();
        return view('dashboard.index', compact(['companyProfiles', 'locale', 'companyProfile']));
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
