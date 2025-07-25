<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Kalau belum ada data produk, bisa kosongin dulu
        return view('produk', compact('user'));
    }
}
