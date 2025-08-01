<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(18);
        $user = Auth::user();
        return view('produk', compact('product', 'user'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('detail.produk', compact('product', 'user'));
    }
}
