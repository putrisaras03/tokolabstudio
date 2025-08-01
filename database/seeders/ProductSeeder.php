<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r992-lx0s4awx2zou43_tn.webp',
                'name' => '“Serbu Serba 9Ribu” 250 Gram Snack Camilan Termurah Enak Varian Aneka Rasa',
                'price' => 10000,
                'total_sales' => 10000,
                'rating' => 4.8,
                'commission' => 1500,
                'product_age_month' => 13,
                'avg_monthly_sales' => 23242,
                'sales_last_30_days' => 10000,
                'review_count' => 73500,
                'stock' => null,
                'sales_trend' => 1230.49,
                'product_url' => 'https://shopee.co.id/%E2%80%9CSerbu-Serba-9Ribu%E2%80%9D-250-Gram-Snack-Camilan-Termurah-Enak-Varian-Aneka-Rasa-i.11134201.26460376043',
            ],
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7ra0s-mbm3zh12vd0094_tn.webp',
                'name' => 'Hightune DIY Nano Block Model Kartun Building Blok Mainan Balok Susun Bricks Mini Brick',
                'price' => 48500,
                'total_sales' => 142,
                'rating' => 4.9,
                'commission' => 8730,
                'product_age_month' => 3,
                'avg_monthly_sales' => 40,
                'sales_last_30_days' => 26,
                'review_count' => 44,
                'stock' => null,
                'sales_trend' => 38.78,
                'product_url' => 'https://shopee.co.id/Hightune-DIY-Nano-Block-Model-Kartun-Building-Blok-Mainan-Balok-Susun-Bricks-Mini-Brick-i.477681717.26834248238?sp_atk=139113d7-7456-4e3a-9202-90bb0b6f1977&xptdk=139113d7-7456-4e3a-9202-90bb0b6f1977',
            ],
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/sg-11134201-7rfi2-m9r5xfyoxmom52_tn.webp',
                'name' => 'Aerostreet Parfum Daily Obsession - Extrait De Parfum PF003',
                'price' => 99900,
                'total_sales' => 1300,
                'rating' => 4.9,
                'commission' => 13485,
                'product_age_month' => 3,
                'avg_monthly_sales' => 456,
                'sales_last_30_days' => 699,
                'review_count' => 589,
                'stock' => null,
                'sales_trend' => 81.74,
                'product_url' => 'https://shopee.co.id/Aerostreet-Parfum-Daily-Obsession-Extrait-De-Parfum-PF003-i.1541744112.40300868302?sp_atk=433fd8b8-3652-4c05-a750-8623f65791a4&xptdk=433fd8b8-3652-4c05-a750-8623f65791a4',
            ],
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7ra0r-mcrjyonsat2ta3_tn.webp',
                'name' => 'SOME BY MI V10 HYAL AIR FIT SUNSCREEN [25ml/50ml]',
                'price' => 100800,
                'total_sales' => 3300,
                'rating' => 4.9,
                'commission' => 20160,
                'product_age_month' => 13,
                'avg_monthly_sales' => 245,
                'sales_last_30_days' => 700,
                'review_count' => 1400,
                'stock' => null,
                'sales_trend' => 201.88,
                'product_url' => 'https://shopee.co.id/SOME-BY-MI-V10-HYAL-AIR-FIT-SUNSCREEN-25ml-50ml--i.455311481.29204771380?sp_atk=24eb2d9b-85c3-4bc7-a2fc-dee42d42c55d&xptdk=24eb2d9b-85c3-4bc7-a2fc-dee42d42c55d',
            ],
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/sg-11134253-7rdxr-mbx0d7q9jo7q8e_tn.webp',
                'name' => 'SIVALI Esme Blazer - Fitted Stripe Shirt Blazer Semi Wool Atasan Wanita Lengan Panjang',
                'price' => 118274,
                'total_sales' => 10000,
                'rating' => 4.9,
                'commission' => 17741,
                'product_age_month' => 7,
                'avg_monthly_sales' => 1179,
                'sales_last_30_days' => 2000,
                'review_count' => 2900,
                'stock' => null,
                'sales_trend' => 49.73,
                'product_url' => 'https://shopee.co.id/SIVALI-Esme-Blazer-Fitted-Stripe-Shirt-Blazer-Semi-Wool-Atasan-Wanita-Lengan-Panjang-i.332848392.26273164017?sp_atk=914a1183-b925-42da-acfb-b499f5bc3664&xptdk=914a1183-b925-42da-acfb-b499f5bc3664',
            ],
        ]);
    }
}
