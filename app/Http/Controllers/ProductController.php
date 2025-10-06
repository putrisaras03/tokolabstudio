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
        $products = Product::with(['category', 'models'])
            ->latest()
            ->paginate(18);

        // Ambil semua kategori untuk filter
        $categories = Category::orderBy('display_name')->get();

        $user = Auth::user();

        return view('produk', compact('products', 'user', 'categories'));
    }

    public function show($id)
        {
            // Ambil produk + kategori + model + total_sold
            $product = Product::withSum('models', 'sold')
                ->with(['categories', 'models'])
                ->where('item_id', $id)
                ->firstOrFail();

            $user = Auth::user();

            return view('detail', compact('product', 'user'));
        }

}
