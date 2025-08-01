<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'product_age_month',
        'avg_monthly_sales',
        'sales_last_30_days',
        'total_sales',
        'rating',
        'review_count',
        'stock',
        'commission',
        'sales_trend',
        'product_url',
        'image_url',
    ];
}
