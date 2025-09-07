<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ShopeeService;
use App\Models\Category;

class FetchShopeeCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopee:fetch-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch categories from Shopee, save to database recursively';

    protected $shopeeService;

    /**
     * Create a new command instance.
     *
     * @param ShopeeService $shopeeService
     */
    public function __construct(ShopeeService $shopeeService)
    {
        parent::__construct();
        $this->shopeeService = $shopeeService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Fetching categories from Shopee...");

        $response = $this->shopeeService->getCategories();

        // Ambil category_list dari response (ShopeeService sudah return $data['data'])
        $categories = $response['category_list'] ?? [];

        if (empty($categories)) {
            $this->warn("No categories found.");
            return 0;
        }

        // Cetak semua kategori secara rekursif dan simpan ke database
        $this->printCategories($categories);

        $this->info("Total top-level categories: " . count($categories));
        return 1;
    }

    /**
     * Recursive function untuk print kategori dan children
     */
    private function printCategories(array $categories, string $prefix = '', $parentCatId = null)
    {
        foreach ($categories as $cat) {
            $catid = $cat['catid'] ?? null;
            $name = $cat['name'] ?? null;
            $displayName = $cat['display_name'] ?? null;

            if ($catid) {
                // Simpan atau update kategori ke database
                Category::updateOrCreate(
                    ['catid' => $catid],
                    [
                        'name' => $name,
                        'display_name' => $displayName,
                        'parent_catid' => $parentCatId
                    ]
                );
            }

            $this->line("{$prefix}ID: {$catid} | Name: {$displayName}");

            // Rekursif untuk children
            if (!empty($cat['children']) && is_array($cat['children'])) {
                $this->printCategories($cat['children'], $prefix . '--', $catid);
            }
        }
    }
}
