<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function main()
    {
        return view('pages.index');
    }

    public function getProducts()
    {
        try {
            $products = Product::with('subcategory')->get(); // Fetch all products with subcategory
            $subcategories = Subcategory::all(); // Fetch all subcategories
            return response()->json(['products' => $products, 'subcategories' => $subcategories]); // Return as JSON
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }

    public function getCategories()
    {
        try {
            $categories = Category::all(); // Fetch all categories
            return response()->json($categories); // Return as JSON
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch categories'], 500);
        }
    }

    public function getSubcategories()
    {
        try {
            $subcategories = Subcategory::all(); // Fetch all categories
            return response()->json($subcategories); // Return as JSON
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch subcategories'], 500);
        }
    }
}
