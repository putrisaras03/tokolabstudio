<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('studios')->insert([
            ['name' => 'Studio 1'],
            ['name' => 'Studio 2'],
            ['name' => 'Studio 3'],
        ]);
    }
}
