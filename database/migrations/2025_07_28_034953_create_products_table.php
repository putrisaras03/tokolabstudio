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
        $table->id();
        $table->bigInteger('item_id')->unique(); // Shopee item id
        $table->string('title');
        $table->string('image')->nullable();
        $table->timestamp('ctime')->nullable();

        // review data
        $table->float('rating_star')->nullable();
        $table->integer('rating_count')->default(0);
        $table->integer('liked_count')->default(0);

        // harga
        $table->bigInteger('price_min_before_discount')->nullable();
        $table->bigInteger('price_max_before_discount')->nullable();
        $table->bigInteger('price_min')->nullable();
        $table->bigInteger('price_max')->nullable();

        // penjualan
        $table->integer('historical_sold')->default(0);

        // kategori utama (1 produk hanya punya 1 kategori utama)
        $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');

        // link & komisi
        $table->string('product_link')->nullable();
        $table->decimal('commission', 10, 2)->nullable();
        $table->decimal('seller_commission', 10, 2)->nullable();
        $table->decimal('shopee_commission', 10, 2)->nullable();

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
