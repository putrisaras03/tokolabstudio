<?php
namespace App\Http\Controllers;

use App\Services\ShopeeService;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(ShopeeService $shopeeService)
    {
        // 1. Ambil kategori dari API Shopee
        $categories = $shopeeService->getCategories();

        // 2. Simpan ke database kalau perlu (optional)
        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['id' => $cat['catid']], // pastikan field id di DB sesuai
                ['name' => $cat['display_name'] ?? '']
            );
        }

        // 3. Ambil dari DB untuk ditampilkan di view
        $categories = Category::all();

        return view('kategori', compact('categories'));
    }
}
