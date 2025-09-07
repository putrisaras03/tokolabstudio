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
        $this->cookiePath = storage_path('cookies/shopee.json');

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
            $parts = explode(';', $set);
            $nv = explode('=', trim($parts[0]), 2);
            if (count($nv) !== 2) continue;

            $name = $nv[0];
            $value = $nv[1];

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

        $this->saveCookies($response);

        $data = json_decode($response->getBody(), true);
        return $data['data'] ?? [];
    }
}
