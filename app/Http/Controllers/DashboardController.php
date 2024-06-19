<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $companyProfile = new stdClass();
        $companyProfile->contentName = '';
        $companyProfile->namaKonten = '';
        $companyProfile->coverImage = '';
        $companyProfile->konten = '';
        $companyProfile->content = '';
        $companyProfile->created_at = '';
        if (sizeof($companyProfiles) > 0) {
            $companyProfile = $companyProfiles[0];
        }
        return view('dashboard.index', compact(['companyProfiles', 'companyProfile']));
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
