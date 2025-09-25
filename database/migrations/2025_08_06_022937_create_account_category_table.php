<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('live_account_category', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('live_account_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('live_account_id')
                ->references('id')->on('live_accounts')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['live_account_id', 'category_id']); // supaya tidak duplikat
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_account_category');
    }
};
