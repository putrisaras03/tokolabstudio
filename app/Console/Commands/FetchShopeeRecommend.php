<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShopeeService;

class FetchShopeeRecommend extends Command
{
    /**
     * Nama & signature command
     *
     * Contoh:
     * php artisan shopee:recommend 11044258 --limit=10 --offset=0
     */
    protected $signature = 'shopee:recommend {catid} {--limit=10} {--offset=0}';

    /**
     * Deskripsi command
     */
    protected $description = 'Fetch recommended products from Shopee by category ID';

    /**
     * Eksekusi command
     */
    public function handle(ShopeeService $shopeeService)
    {
        $catid  = (int) $this->argument('catid');
        $limit  = (int) $this->option('limit');
        $offset = (int) $this->option('offset');

        $this->info("Fetching recommended products for category: {$catid} (offset={$offset}, limit={$limit})");

        try {
            $data = $shopeeService->getRecommend($catid, $offset, $limit);

            if (empty($data['data']['sections'])) {
                $this->error("No data returned or got blocked (maybe invalid cookies)");
                return 1;
            }

            foreach ($data['data']['sections'] as $section) {
                if (!isset($section['data']['item'])) continue;

                foreach ($section['data']['item'] as $item) {
                    $this->line(" - {$item['itemid']} | {$item['name']} | Terjual: {$item['historical_sold']}");
                }
            }

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
