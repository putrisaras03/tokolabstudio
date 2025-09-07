<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShopeeService;
use App\Models\Product;

class FetchShopeeCategoryProducts extends Command
{
    protected $signature = 'shopee:fetch-category-products {catid?} {--limit=2}';
    protected $description = 'Fetch products by category from Shopee including rating and affiliate commission';

    protected $shopee;

    public function __construct(ShopeeService $shopee)
    {
        parent::__construct();
        $this->shopee = $shopee;
    }

    public function handle()
    {
        $catid = (int) ($this->argument('catid') ?? 11044258); // default Elektronik
        $limit = (int) $this->option('limit');

        $this->info("Fetching {$limit} produk dari kategori {$catid}...");

        $shopee = new ShopeeService();
        $products = $shopee->getProductsByCategory($catid, $limit);

        foreach ($products as $p) {
            $this->line("🛒 {$p['title']}");
            $this->line("   ⭐ Rating: {$p['rating_star']}");
            $this->line("   🔗 Link: {$p['product_link']}");
            $this->line("   💰 Komisi: " . ($p['commission'] ?? 'N/A'));
            $this->line("   ✂️ Shortlink: " . ($p['shortlink'] ?? 'N/A'));
            $this->newLine();
        }

        $this->info("Selesai! Total produk diambil: " . count($products));
    }
}
