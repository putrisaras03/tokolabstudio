<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sort dan search
        $sort = $request->get('sort');
        $search = $request->get('search');

        // Query dasar produk dengan relasi
        $query = Product::with(['category', 'models']);

        // 🔍 Filter pencarian (cocok sebagian, case-insensitive)
        if (!empty($search)) {
            $query->whereRaw('LOWER(title) LIKE LOWER(?)', ['%' . trim($search) . '%']);
        }

        // 🧩 Terapkan urutan sesuai pilihan user
        switch ($sort) {
            case 'komisi_tertinggi':
                $query->orderBy('commission', 'desc');
                break;

            case 'rating_tertinggi':
                $query->orderBy('rating_star', 'desc');
                break;

            case 'terlaris':
                $query->orderBy('historical_sold', 'desc');
                break;

            case 'terbaru':
                $query->orderBy('ctime', 'desc');
                break;

            default:
                $query->latest(); // fallback: urut berdasarkan created_at terbaru
                break;
        }

        // 🔢 Pagination
        $products = $query->paginate(18);

        // 📂 Ambil kategori untuk filter
        $categories = Category::orderBy('display_name')->get();

        // 👤 Ambil user login
        $user = Auth::user();

        // 📤 Kirim data ke view
        return view('produk', compact('products', 'user', 'categories', 'sort'));
    }

    public function show($id)
    {
        $product = Product::withSum('models', 'sold')
            ->with(['categories', 'models'])
            ->where('item_id', $id)
            ->firstOrFail();

        $user = Auth::user();

        // Total sold aman
        $modelsSold = (int) ($product->models_sum_sold ?? 0);

        // --- Deteksi format ctime ---
        $ctime = $product->ctime;

        if (is_numeric($ctime)) {
            $ctimeInt = (int) $ctime;
            // jika milidetik (panjang > 10)
            $createdAt = strlen((string) $ctimeInt) > 10
                ? Carbon::createFromTimestampMs($ctimeInt)
                : Carbon::createFromTimestamp($ctimeInt);
        } else {
            $createdAt = Carbon::parse($ctime);
        }

        // --- Hitung umur produk dalam bulan ---
        $diffDays = $createdAt->diffInDays(now());
        $umurProduk = max(1, round($diffDays / 30, 1)); // hasil 14.3 → 14.3 bulan (1 desimal)

        // Jika ingin ditampilkan bulat tapi tidak berlebihan, bisa pakai floor()
        $umurProdukBulat = max(1, floor($diffDays / 30)); // hasil 14.3 → 14 bulan

        // --- Hitung rata-rata per bulan (pakai umur bulat agar logis) ---
        $rataPerBulan = $umurProdukBulat > 0 ? ceil($modelsSold / $umurProdukBulat) : $modelsSold;

        // --- Hitung total pendapatan ---
        $totalPendapatan = ($product->price_min / 100000) * $product->historical_sold;

        // --- Total omset varian ---
        $omsetVarian = $product->models->sum(function ($model) {
            return ($model->price / 100000) * $model->sold;
        });

        // --- Rata-rata pendapatan per bulan ---
        $rataPendapatanPerBulan = $umurProdukBulat > 0
            ? ceil($totalPendapatan / $umurProdukBulat)
            : $totalPendapatan;

        return view('detail', compact(
            'product',
            'user',
            'umurProduk',
            'umurProdukBulat',
            'rataPerBulan',
            'totalPendapatan',
            'omsetVarian',
            'rataPendapatanPerBulan',
            'createdAt'
        ));
    }
}
