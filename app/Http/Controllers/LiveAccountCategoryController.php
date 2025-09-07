<?php

namespace App\Http\Controllers;

use App\Models\LiveAccount;
use App\Models\Category;
use Illuminate\Http\Request;

class LiveAccountCategoryController extends Controller
{
    /**
     * Tampilkan form untuk atur kategori akun live
     */
    public function editCategories($liveAccountId)
    {
        $liveAccount= LiveAccount::with('categories')->findOrFail($liveAccountId);
        $categories = Category::all();

        return view('kategori', compact('liveAccount', 'categories'));
    }

    public function updateCategories(Request $request, $liveAccountId)
    {
        $liveAccount = LiveAccount::findOrFail($liveAccountId);

        $selectedCategories = $request->input('categories', []); // array kategori yang dipilih

        // Sync relasi many-to-many
        $liveAccount->categories()->sync($selectedCategories);

        return redirect()->route('live_accounts.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyCategory($liveAccountId, $categoryId)
    {
        $liveAccount = LiveAccount::findOrFail($liveAccountId);

        // Lepas relasi kategori dengan akun live
        $liveAccount->categories()->detach($categoryId);

        return redirect()->back()->with('success', 'Kategori berhasil dihapus dari akun live.');
    }

}