<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'title',
        'image',
        'ctime',
        'price_min_before_discount',
        'price_max_before_discount',
        'price_min',
        'price_max',
        'historical_sold',
        'product_link',
        'commission',
        'seller_commission',
        'shopee_commission',
        'rating_star',
        'rating_count',
        'liked_count',
        'category_id',
    ];

    protected $casts = [
        'ctime' => 'datetime',
    ];

    /**
     * Relasi 1 produk -> banyak varian (models)
     */
    public function models()
    {
        return $this->hasMany(ProductModel::class);
    }

    /**
     * Relasi 1 produk -> 1 metadata
     */
    public function metadata()
    {
        return $this->hasOne(ProductMetadata::class);
    }

    /**
     * Relasi 1 produk -> 1 kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
