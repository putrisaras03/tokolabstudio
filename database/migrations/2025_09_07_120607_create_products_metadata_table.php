<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // Ringkasan Penjualan
            $table->integer('penjualan_total')->default(0);
            $table->integer('penjualan_total_varian')->default(0);
            $table->decimal('penjualan_rata_rata_bulan', 12, 2)->default(0);
            $table->integer('penjualan_30_hari')->default(0);

            // Metrik Pendapatan
            $table->string('rentang_harga')->nullable();
            $table->decimal('total_pendapatan', 12, 2)->default(0);
            $table->decimal('omset_total_varian', 12, 2)->default(0);
            $table->decimal('rata_rata_omset_bulan', 12, 2)->default(0);
            $table->decimal('pendapatan_30_hari', 12, 2)->default(0);

            // Detail Produk
            $table->timestamp('dibuat')->nullable();
            $table->integer('umur')->default(0);
            $table->integer('jumlah_varian')->default(0);
            $table->string('trend')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_metadata');
    }
};
