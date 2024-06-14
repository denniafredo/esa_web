<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BrandController extends Controller
{
    public function index()
    {
        $data = Brand::all();
        return view('admin.brand.index', compact('data'));
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $namaBrand = $request->input('name');

            $checkBrand = Brand::where('name', $namaBrand)->first();
            if ($checkBrand) {
                return redirect()->route('brand.index')->with('info', 'Brand Already exists');
            }

            $brand = Brand::create(['name' => $namaBrand]);
            $brandId = $brand->id;

            $kategories = $request->input('kategori');
            $categories = $request->input('category');

            $categoryData = [];
            for ($i = 0; $i < count($kategories); $i++) {
                $kategori = $kategories[$i];
                $category = $categories[$i];
                if ($kategori && $category) {
                    $categoryData[] = [
                        'brand_id' => $brandId,
                        'nama' => $kategori,
                        'name' => $category,
                    ];

                }
            }

            // Insert all categories at once
            if (!empty($categoryData)) {
                Category::insert($categoryData);
            }
            return redirect()->route('brand.index')->with('success', 'Brand Added Successfully with ' . count($categoryData) . ' categories.');
        } catch (Exception $e) {
            return redirect()->route('brand.index')->with('error', 'An error while saving new Brand');
        }
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function edit()
    {
        $brandId = Route::current()->parameter('brand');
        $data = Brand::where('id', $brandId)->first();
        return view('admin.brand.edit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $namaBrand = $request->input('name');

            $checkBrand = Brand::where('name', $namaBrand)->where('id', '!=', $id)->first();
            if ($checkBrand) {
                return redirect()->route('brand.index')->with('info', 'Brand Already used');
            }

            $brand = Brand::findOrFail($id);
            Category::where('brand_id', $brand->id)->delete();
            $kategories = $request->input('kategori');
            $categories = $request->input('category');

            $categoryData = [];
            for ($i = 0; $i < count($kategories); $i++) {
                $kategori = $kategories[$i];
                $category = $categories[$i];
                if ($kategori && $category) {
                    $categoryData[] = [
                        'brand_id' => $brand->id,
                        'nama' => $kategori,
                        'name' => $category,
                    ];
                }
            }
            if (!empty($categoryData)) {
                Category::insert($categoryData);
            }
            return redirect()->route('brand.index')->with('success', 'Brand Updated Successfully with ' . count($categoryData) . ' categories.');
        } catch (Exception $e) {
            return redirect()->route('brand.index')->with('error', 'An error while saving new Brand');
        }
    }


    public function destroy($id)
    {
        try {
            Brand::destroy($id);
            return redirect()->route('brand.index')->with('success', 'Brand Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            Log::error('Error deleting article: ' . $e->getMessage());
            return redirect()->route('brand.index')->with('error', 'An error occurred while deleting the brand. Please try again.');
        }
    }


}
