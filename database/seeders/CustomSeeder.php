<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\CitiesSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\BloodTypesSeeder;
use Database\Seeders\GovernoratesSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            // BloodTypesSeeder::class,
            //CategorySeeder::class,
            GovernoratesSeeder::class,
            //PostSeeder::class,
            //CitiesSeeder::class,
        ]);
    }
}

//php artisan db:seed --class=CustomSeeder