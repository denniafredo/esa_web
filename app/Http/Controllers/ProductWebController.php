<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CompanyProfile;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index(Request $request)
    {
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();

        $brands = Brand::all();
        $brandId = $request->input('brand');
        $categoryId = $request->input('category');
        $productName = $request->input('searchProduct');
        $selectedBrand = null;

        // Initialize the query builder for products
        $productsQuery = Product::query();

        // Apply brand filter if $brandId is present
        if ($brandId) {
            $productsQuery->where('brand_id', $brandId);
            $selectedBrand = Brand::find($brandId);
        }

        // Apply category filter if $categoryId is present
        if ($categoryId) {
            $productsQuery->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        if ($productName) {
            $productsQuery = Product::query();
            $productsQuery->where(function ($query) use ($productName) {
                $query->where('name', 'like', '%' . $productName . '%')
                    ->orWhere('description', 'like', '%' . $productName . '%')
                    ->orWhere('nama', 'like', '%' . $productName . '%')
                    ->orWhere('deskripsi', 'like', '%' . $productName . '%');
            });
            $selectedBrand = null;
        }

        // Fetch the products collection based on the applied filters
        $products = $productsQuery->get();

        return view('product.index', compact(['products', 'brands', 'selectedBrand', 'companyProfiles']));
    }


    public function show($id)
    {
        $companyProfiles = CompanyProfile::orderBy('urutan')->get();
        $product = Product::find($id);
        return view('product.show', compact(['product', 'companyProfiles']));
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
