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
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98q-lur44i33mxgs3d_tn.webp',
                'name' => 'Nature’s Market - Granola Bar / Snack Sehat / Cemilan Sehat - 20 gram',
                'price' => 3850,
                'total_sales' => 24000,
                'rating' => 4.9,
                'commission' => 808,
                'product_age_month' => 31,
                'avg_monthly_sales' => 774,
                'sales_last_30_days' => 1600,
                'review_count' => 9500,
                'stock' => null,
                'sales_trend' => 206.69,
                'product_url' => 'https://shopee.co.id/Nature’s-Market-Granola-Bar-Snack-Sehat-Cemilan-Sehat-20-gram-i.32737706.2079657271',
            ],
            // Produk ke-7
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98v-ln5goq6ycnkt5b_tn.webp',
                'name' => 'MS Glow Facial Wash - Sabun Cuci Muka Pencerah Wajah / Cleanser MS GLOW',
                'price' => 60000,
                'total_sales' => 5400,
                'rating' => 4.9,
                'commission' => 7200,
                'product_age_month' => 17,
                'avg_monthly_sales' => 272,
                'sales_last_30_days' => 1000,
                'review_count' => 700,
                'stock' => null,
                'sales_trend' => 367.65,
                'product_url' => 'https://shopee.co.id/MS-Glow-Facial-Wash-Sabun-Cuci-Muka-Pencerah-Wajah-Cleanser-MS-GLOW-i.1477832.16893453560',
            ],
            // Produk ke-8
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7qul3-ljo6z5l5hxx29a_tn.webp',
                'name' => 'JAPSTYLE SHORT CARGO BLACK EDITION | CELANA PENDEK PRIA BLACK CARGO',
                'price' => 69000,
                'total_sales' => 6800,
                'rating' => 4.8,
                'commission' => 10350,
                'product_age_month' => 12,
                'avg_monthly_sales' => 469,
                'sales_last_30_days' => 1000,
                'review_count' => 2400,
                'stock' => null,
                'sales_trend' => 213.23,
                'product_url' => 'https://shopee.co.id/JAPSTYLE-SHORT-CARGO-BLACK-EDITION-CELANA-PENDEK-PRIA-BLACK-CARGO-i.385250325.18696568840',
            ],
            // Produk ke-9
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/sg-11134201-7r98q-lom3mnqzn8eyec_tn.webp',
                'name' => 'Serum Retinol Scarlett Whitening untuk Anti Aging & Jerawat | Night Serum',
                'price' => 75000,
                'total_sales' => 1500,
                'rating' => 4.9,
                'commission' => 11250,
                'product_age_month' => 7,
                'avg_monthly_sales' => 132,
                'sales_last_30_days' => 500,
                'review_count' => 500,
                'stock' => null,
                'sales_trend' => 378.79,
                'product_url' => 'https://shopee.co.id/Serum-Retinol-Scarlett-Whitening-untuk-Anti-Aging-Jerawat-Night-Serum-i.194827617.17555172174',
            ],
            // Produk ke-10
            [
                'image_url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98w-lv27nnoem9n2ab_tn.webp',
                'name' => 'Minyak Kayu Putih Cap Lang 60 ml - Cap Lang Cajuput Oil 60 ml',
                'price' => 18500,
                'total_sales' => 5100,
                'rating' => 4.9,
                'commission' => 2220,
                'product_age_month' => 15,
                'avg_monthly_sales' => 352,
                'sales_last_30_days' => 800,
                'review_count' => 1300,
                'stock' => null,
                'sales_trend' => 227.27,
                'product_url' => 'https://shopee.co.id/Minyak-Kayu-Putih-Cap-Lang-60-ml-Cap-Lang-Cajuput-Oil-60-ml-i.439152066.19699438378',
            ],
        ]);
    }
}
