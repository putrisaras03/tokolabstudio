<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        // Ringkasan Penjualan
        'product_id',
        'penjualan_total',
        'penjualan_total_varian',
        'penjualan_rata_rata_bulan',
        'penjualan_30_hari',

        // Metrik Pendapatan
        'rentang_harga',
        'total_pendapatan',
        'omset_total_varian',
        'rata_rata_omset_bulan',
        'pendapatan_30_hari',

        // Detail Produk
        'dibuat',
        'umur',
        'jumlah_varian',
        'trend',
    ];

    protected $casts = [
        'dibuat' => 'datetime',
    ];

    /**
     * Relasi metadata -> produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
