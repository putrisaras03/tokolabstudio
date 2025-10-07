<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
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
        $product = Product::withSum('models', 'sold')
            ->with(['categories', 'models'])
            ->where('item_id', $id)
            ->firstOrFail();

        $user = Auth::user();

        // pastikan total sold (fallback ke 0)
        $modelsSold = (int) ($product->models_sum_sold ?? 0);

        // DETEKSI format ctime dengan aman:
        $ctime = $product->ctime;

        if (is_numeric($ctime)) {
            $ctimeInt = (int) $ctime;
            // bila panjang > 10 kemungkinan milidetik
            if (strlen((string) $ctimeInt) > 10) {
                // milidetik
                $createdAt = Carbon::createFromTimestampMs($ctimeInt);
            } else {
                // detik
                $createdAt = Carbon::createFromTimestamp($ctimeInt);
            }
        } else {
            // string datetime (contoh: "2024-10-03 12:00:00")
            $createdAt = Carbon::parse($ctime);
        }

        // Hitung umur dalam bulan (bulat ke atas), minimal 1 bulan untuk hindari pembagian 0
        $umurProduk = (int) max(1, ceil($createdAt->diffInDays(now()) / 30));

        // Rata-rata per bulan (1 desimal)
        $rataPerBulan = $umurProduk > 0 ? ceil($modelsSold / $umurProduk) : $modelsSold;

        // Hitung total pendapatan
        $totalPendapatan = ($product->price_min / 100000) * $product->historical_sold;

        // Hitung total omset varian (sum of sold * price)
        $omsetVarian = $product->models->sum(function ($model) {
            return ($model->price / 100000) * $model->sold;
        });

        // Rata-rata pendapatan per bulan
        $rataPendapatanPerBulan = $umurProduk > 0 ? ceil($totalPendapatan / $umurProduk) : $totalPendapatan;

        return view('detail', compact('product', 'user', 'umurProduk', 'rataPerBulan', 'totalPendapatan', 'omsetVarian', 'rataPendapatanPerBulan'));
    }
}
