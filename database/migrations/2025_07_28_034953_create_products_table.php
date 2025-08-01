<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary(); // ID otomatis
            $table->text('image_url')->nullable(); // URL gambar produk
            $table->text('name');
            $table->bigInteger('price');
            $table->bigInteger('total_sales')->nullable(); // total penjualan produk
            $table->decimal('rating', 2, 1)->nullable();
            $table->bigInteger('commission')->nullable(); // komisi Shopee (dalam % atau nominal)
            $table->integer('product_age_month')->nullable(); // umur produk (dalam hari)
            $table->bigInteger('avg_monthly_sales')->nullable(); // penjualan rata-rata per bulan
            $table->bigInteger('sales_last_30_days')->nullable(); // penjualan 30 hari terakhir
            $table->bigInteger('review_count')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('sales_trend', 6, 2)->nullable(); // tren penjualan (%)
            $table->text('product_url')->nullable(); // link ke produk Shopee
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
