<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'product_id',
        'name',
        'price',
        'stock',
        'sold',
    ];

    /**
     * Relasi varian -> produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
