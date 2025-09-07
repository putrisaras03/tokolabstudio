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
                ['catid' => $cat['catid']], // pakai 'catid' untuk matching dengan Shopee
                [
                    'display_name' => $cat['display_name'] ?? '',
                    'parent_id'    => $cat['parent_catid'] ?? null, // kalau ada parent, simpan
                ]
            );
        }

        // 3. Ambil dari DB untuk ditampilkan di view
        $categories = Category::all();

        return view('kategori', compact('categories'));
    }
}
