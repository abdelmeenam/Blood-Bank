<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'القاهرة', 'governorate_id' => 1],
            ['name' => 'الجيزة', 'governorate_id' => 1],
            ['name' => 'العاشر من رمضان', 'governorate_id' => 1],
            ['name' => 'الإسكندرية', 'governorate_id' => 2],
            // Add more cities with their respective governorate IDs
        ];

        DB::table('cities')->insert($cities);
    }
}