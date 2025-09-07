<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('model_id')->unique();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_models');
    }
};
