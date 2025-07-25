<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 user dengan data tetap
        User::create([
            'username' => 'Test User',
            'email' => 'admintokolabs@gmail.com',
            'password' => Hash::make('tokolabs'),
            'phone' => '088990825179',
            'remember_token' => Str::random(10),
        ]);
    }
}
