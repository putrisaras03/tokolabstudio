<?php

namespace App\Http\Controllers;

use App\Models\LiveAccount;
use App\Models\Category;
use Illuminate\Http\Request;

class LiveAccountCategoryController extends Controller
{
    // Tampilkan halaman atur kategori
    public function edit($liveAccountId)
    {
        $liveAccount = LiveAccount::with('categories')->findOrFail($liveAccountId);

        // id kategori yang sudah dipilih akun ini
        $selectedCategoryIds = $liveAccount->categories->pluck('id');

        // kategori yang sudah dipilih
        $selectedCategories = $liveAccount->categories;

        // kategori tersedia (belum dipilih, parent_id null)
        $availableCategories = Category::whereNull('parent_id')
            ->whereNotIn('id', $selectedCategoryIds)
            ->get();

        return view('kategori', [
            'liveAccount'         => $liveAccount,
            'selectedCategories'  => $selectedCategories,
            'availableCategories' => $availableCategories,
        ]);
    }

    // Simpan kategori yang dipilih
    public function update(Request $request, $liveAccountId)
    {
        $liveAccount = LiveAccount::findOrFail($liveAccountId);

        // Simpan kategori terpilih ke pivot
        $liveAccount->categories()->sync($request->categories ?? []);

        return redirect()
            ->route('live_accounts.categories.edit', $liveAccount->id)
            ->with('success', 'Kategori berhasil diperbarui!');
    }
    
    // Hapus kategori dari akun
    public function destroy($liveAccountId, $categoryId)
    {
        $liveAccount = LiveAccount::findOrFail($liveAccountId);

        $liveAccount->categories()->detach($categoryId);

        return redirect()
            ->route('live_accounts.categories.edit', $liveAccount->id)
            ->with('success', 'Kategori berhasil dihapus');
    }
}
