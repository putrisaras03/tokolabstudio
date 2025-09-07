<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Storage;

class ShopeeService
{
    protected $client;
    protected $cookiePath;

    public function __construct()
    {
        // Path file cookie
        $this->cookiePath = storage_path('cookies/shopee.json');

        // Setup Guzzle client dengan header yang mirip browser
        $this->client = new Client([
            'base_uri' => 'https://shopee.co.id',
            'timeout'  => 30,
            'headers' => [
                'Accept'             => '*/*',
                'Accept-Language'    => 'id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,ms;q=0.6',
                'User-Agent'         => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',
                'Referer'            => 'https://shopee.co.id/?is_from_login=true',
                'X-Requested-With'   => 'XMLHttpRequest',
                'X-Api-Source'       => 'pc',
                'X-Shopee-Language'  => 'id',
                'Sec-Fetch-Site'     => 'same-origin',
                'Sec-Fetch-Mode'     => 'cors',
                'Sec-Fetch-Dest'     => 'empty',
                'Sec-CH-UA'          => '"Not;A=Brand";v="99", "Google Chrome";v="139", "Chromium";v="139"',
                'Sec-CH-UA-Platform' => '"Windows"',
                'Sec-CH-UA-Mobile'   => '?0',
            ],
        ]);
    }

    /**
     * Load cookies dari file JSON ke CookieJar
     */
    protected function loadCookies(): CookieJar
    {
        if (!file_exists($this->cookiePath)) {
            return new CookieJar();
        }

        $cookies = json_decode(file_get_contents($this->cookiePath), true) ?? [];

        $cookieArray = [];
        foreach ($cookies as $cookie) {
            $cookieArray[$cookie['name']] = $cookie['value'];
        }

        return CookieJar::fromArray($cookieArray, '.shopee.co.id');
    }

    /**
     * Merge cookies baru dari response Set-Cookie ke file JSON
     */
    protected function saveCookies($response): void
    {
        $setCookies = $response->getHeader('Set-Cookie');

        if (empty($setCookies)) return;

        $existing = json_decode(file_get_contents($this->cookiePath) ?? '[]', true);

        foreach ($setCookies as $set) {
            // Parse nama & value dari Set-Cookie
            $parts = explode(';', $set);
            $nv = explode('=', trim($parts[0]), 2);
            if (count($nv) !== 2) continue;

            $name = $nv[0];
            $value = $nv[1];

            // Update existing cookie jika ada
            $found = false;
            foreach ($existing as &$c) {
                if ($c['name'] === $name) {
                    $c['value'] = $value;
                    $found = true;
                    break;
                }
            }
            unset($c);

            if (!$found) {
                // Tambahkan cookie baru
                $existing[] = [
                    'domain'   => '.shopee.co.id',
                    'name'     => $name,
                    'value'    => $value,
                    'path'     => '/',
                    'httpOnly' => true,
                    'secure'   => true,
                ];
            }
        }

        file_put_contents($this->cookiePath, json_encode($existing, JSON_PRETTY_PRINT));
    }

    /**
     * Ambil kategori dari Shopee
     */
    public function getCategories(): array
    {
        $cookieJar = $this->loadCookies();

        $response = $this->client->get('/api/v4/pages/get_category_tree', [
            'cookies' => $cookieJar,
        ]);

        // Merge cookies baru
        $this->saveCookies($response);

        $data = json_decode($response->getBody(), true);

        return $data['data'] ?? [];
    }

        /**
     * Ambil produk berdasarkan kategori (catid)
     */
    public function getProductsByCategory(int $catid, int $limit = 2): array
    {
        $cookieJar = $this->loadCookies();

        // 1. Ambil list produk di kategori
        $response = $this->client->get('/api/v4/recommend/recommend_v2', [
            'cookies' => $cookieJar,
            'query' => [
                'catid' => $catid,
                'limit' => $limit,
                'offset' => 0,
                'bundle' => 'category_landing_page',
                'section' => 'popular',
            ],
        ]);

        $this->saveCookies($response);

        $data = json_decode($response->getBody(), true);
        $items = $data['data']['sections'][0]['data']['item'] ?? [];

        $results = [];

        foreach ($items as $item) {
            $itemId = $item['itemid'];
            $shopId = $item['shopid'];

            // 2. Detail produk (get_pc)
            $detailRes = $this->client->get('/api/v4/pdp/get_pc', [
                'cookies' => $cookieJar,
                'query' => [
                    'item_id' => $itemId,
                    'shop_id' => $shopId,
                    'tz_offset_minutes' => 420,
                    'detail_level' => 0,
                ],
            ]);
            $detail = json_decode($detailRes->getBody(), true);

            // 3. Rating produk
            $ratingRes = $this->client->get('/api/v2/item/get_ratings', [
                'cookies' => $cookieJar,
                'query' => [
                    'filter' => 0,
                    'flag' => 1,
                    'limit' => 5,
                    'offset' => 0,
                    'type' => 0,
                    'shopid' => $shopId,
                    'itemid' => $itemId,
                ],
            ]);
            $rating = json_decode($ratingRes->getBody(), true);

            // 4. Komisi & shortlink (via affiliate API)
            $affiliateClient = new Client([
                'base_uri' => 'https://affiliate.shopee.co.id',
                'timeout'  => 30,
                'headers'  => $this->client->getConfig('headers'), // reuse header
            ]);
            $affRes = $affiliateClient->get('/api/v3/offer/product', [
                'cookies' => $cookieJar,
                'query' => [
                    'item_id' => $itemId,
                ],
            ]);
            $affiliate = json_decode($affRes->getBody(), true);

            $results[] = [
                'title'        => $detail['data']['title'] ?? '',
                'rating_star'  => $rating['data']['item_rating_summary']['rating_star'] ?? 0,
                'product_link' => "https://shopee.co.id/product/{$shopId}/{$itemId}",
                'commission'   => $affiliate['data']['commission_rate'] ?? null,
                'shortlink'    => $affiliate['data']['short_link'] ?? null,
            ];
        }

        return $results;
    }
}
