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
        // Ambil produk terbaru dengan relasi category, models, metadata
        $products = Product::with(['category', 'metadata'])
            ->latest()
            ->paginate(18);

        // Ambil semua kategori untuk filter
        $categories = Category::orderBy('display_name')->get();

        $user = Auth::user();

        return view('produk', compact('products', 'user', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['category', 'metadata'])
            ->where('item_id', $id)
            ->firstOrFail();

        $metadata = $product->metadata; // ambil metadata langsung

        $user = Auth::user();

        return view('detail', compact('product', 'metadata', 'user'));
    }

}
