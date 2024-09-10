<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        
        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
}
