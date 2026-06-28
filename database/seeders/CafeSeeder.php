<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CafeSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            DB::table('cafes')->insert([
                'name'       => 'Café ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}