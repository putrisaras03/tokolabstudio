<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Aksesoris',
            'Ibu & Bayi',
            'Pakaian Wanita',
            'Buku & Alat Tulis',
            'Jam Tangan',
            'Perawatan & Kecantikan',
            'Elektronik',
            'Kesehatan',
            'Perlengkapan Rumah',
            'Fashion Bayi & Anak',
            'Komputer & Aksesoris',
            'Sepatu Pria',
            'Fashion Muslim',
            'Makanan & Minuman',
            'Sepatu Wanita',
            'Fotografi',
            'Olahraga & Outdoor',
            'Souvenir & Perlengkapan Pesta',
            'Handphone & Aksesoris',
            'Otomotif',
            'Tas Pria',
            'Hobi & Koleksi',
            'Pakaian Pria',
            'Tas Wanita'
        ];

        foreach ($categories as $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
