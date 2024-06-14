<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return view('admin.product.index', compact('data'));
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'name' => 'required',
                'brand' => 'required',
                'description' => 'required',
                'deskripsi' => 'required',
                'productImage' => 'required',
            ]);
            $productImage = $request->file('productImage');
            $productImageName = time() . '_' . $productImage->getClientOriginalName();
            $productImagePath = '/storage/product_images/' . $productImageName; // Assuming you want to product images in /storage/product_images folder

            $productImage->move(public_path('storage/product_images'), $productImageName);

            $data = [
                'image' => $productImagePath,
                'nama' => $request->input('nama'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'deskripsi' => $request->input('deskripsi'),
                'brand_id' => $request->input('brand'),
            ];

            $product = Product::create($data);

            $categories = $request->input('category');

            $categoryProductData = [];
            for ($i = 0; $i < count($categories); $i++) {
                $category = $categories[$i];
                if ($category) {
                    $categoryProductData[] = [
                        'product_id' => $product->id,
                        'category_id' => intval($category),
                    ];

                }
            }

            if (!empty($categoryProductData)) {
                ProductCategory::insert($categoryProductData);
            }
            return redirect()->route('product.index')->with('success', 'Product Added Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('product.index')->with('error', 'An error occurred while uploading cover image. Please try again.');
        }
    }

    public function create()
    {
        $brands = Brand::all();
        return view('admin.product.create', compact(['brands']));
    }

    public function edit()
    {
        $productId = Route::current()->parameter('product');
        $data = Product::where('id', $productId)->first();
        $brands = Brand::all();
        $selectedCategories = ProductCategory::where('product_id', $productId)->pluck('category_id')->toArray();
        $categories = Category::where('brand_id', $data->brand_id)->get();
        return view('admin.product.edit', compact(['data', 'brands', 'categories', 'selectedCategories']));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'name' => 'required',
                'brand' => 'required',
                'description' => 'required',
                'deskripsi' => 'required',
            ]);

            $product = Product::findOrFail($id);

            // Prepare data for updating
            $data = $request->only(['nama', 'name', 'brand', 'deskripsi', 'description']);

            // Handle file upload if a new cover image is provided
            if ($request->file('image')) {
                $productImage = $request->file('image');
                $productImageName = time() . '_' . $productImage->getClientOriginalName();
                $productImagePath = '/storage/product_images/' . $productImageName; // Assuming you want to product images in /storage/product_images folder

                // Move the new file to the desired location
                $productImage->move(public_path('storage/product_images'), $productImageName);

                // Add the new cover image path to the data array
                $data['image'] = $productImagePath;

                // Optionally, delete the old cover image file if it exists
                if ($product->image) {
                    $oldImagePath = public_path($product->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            $product->update($data);
            ProductCategory::where('product_id', $id)->delete();

            $categories = $request->input('category');
            $categoryProductData = [];
            for ($i = 0; $i < count($categories); $i++) {
                $category = $categories[$i];
                if ($category) {
                    $categoryProductData[] = [
                        'product_id' => $product->id,
                        'category_id' => intval($category),
                    ];

                }
            }

            if (!empty($categoryProductData)) {
                ProductCategory::insert($categoryProductData);
            }
            return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
            // Log the exception and return an error message
            return redirect()->route('product.index')->with('error', 'An error occurred while updating the product. Please try again.');
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Optionally, delete the cover image file if it exists
            if ($product->image) {
                $productImagePath = public_path($product->image);
                if (file_exists($productImagePath)) {
                    unlink($productImagePath);
                }
            }

            // Delete the product
            $product->delete();

            return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
        } catch (Exception $e) {
            // Log the exception and return an error message
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->route('product.index')->with('error', 'An error occurred while deleting the product. Please try again.');
        }
    }

    public function getCategoriesByBrand($brandId)
    {
        $categories = Category::where('brand_id', $brandId)->get();
        return response()->json($categories);
    }
}
