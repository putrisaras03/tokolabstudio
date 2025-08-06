<?php

namespace App\Http\Controllers;

use App\Models\LiveAccount;
use App\Models\Studio;
use Illuminate\Http\Request;

class LiveAccountController extends Controller
{
    /**
     * Tampilkan daftar akun live.
     */
    public function index()
    {
        $liveAccounts = LiveAccount::with('studio')->get();
        $studios = Studio::all();
        return view('etalase', compact('liveAccounts', "studios"));
    }

    /**
     * Tampilkan form untuk menambahkan akun live baru.
     */
    public function create()
    {
        $studios = Studio::all(); // Ambil semua data studio
        return view('etalase', compact('studios'));
    }

    /**
     * Simpan akun live baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'studio_id' => 'required|exists:studios,id',
        ]);

        LiveAccount::create([
            'name' => $request->name,
            'studio_id' => $request->studio_id,
        ]);

            return redirect()->back()->with('success', 'Akun berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit akun live.
     */
    public function edit($id)
    {
        $liveAccount = LiveAccount::findOrFail($id);
        $studios = Studio::all();
        return view('live_accounts.edit', compact('liveAccount', 'studios'));
    }

    /**
     * Update data akun live.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'studio_id' => 'required|exists:studios,id',
        ]);

        $liveAccount = LiveAccount::findOrFail($id);
        $liveAccount->update([
            'name' => $request->name,
            'studio_id' => $request->studio_id,
        ]);

        return redirect()->route('live-accounts.index')->with('success', 'Akun live berhasil diperbarui!');
    }

    /**
     * Hapus akun live.
     */
    public function destroy($id)
    {
        $liveAccount = LiveAccount::findOrFail($id);
        $liveAccount->delete();

        return redirect()->route('live-accounts.index')->with('success', 'Akun live berhasil dihapus!');
    }
}
