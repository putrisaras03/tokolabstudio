<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(18);
        $categories = Category::orderBy('name')->get();
        $user = Auth::user();
        return view('produk', compact('product', 'user', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        return view('detail.produk', compact('product', 'user'));
    }
}
