<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_sales_histories', function (Blueprint $table) {

            // relasi ke produk
            $table->unsignedBigInteger('product_item_id');
            $table->foreign('product_item_id')
                  ->references('item_id')
                  ->on('products')
                  ->onDelete('cascade');

            // tanggal pencatatan
            $table->date('record_date');

            // total historical sold di hari tersebut (dari Shopee)
            $table->integer('historical_sold')->default(0);

            // selisih dengan hari sebelumnya (penjualan hari itu)
            $table->integer('daily_sold')->default(0);

            // nilai trend berdasarkan perbandingan growth rate penjualan
            $table->decimal('trend_score', 8, 2)->nullable()
                  ->comment('Nilai tren penjualan (persentase atau skor hasil perhitungan)');

            $table->timestamps();

            // agar 1 produk hanya punya 1 catatan per hari
            $table->unique(['product_item_id', 'record_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_sales_histories');
    }
};
