<?php

namespace Database\Seeders;

use App\Models\Category;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ar_SA'); // Use Arabic locale

        // Define Arabic medical categories
        $categories = [
            'طب القلب',
            'الجلدية',
            'الجهاز الهضمي',
            'طب الأعصاب',
            'طب الأورام',
            'العظام',
            'طب الأطفال',
            'طب النفسي',
            'الأشعة',
            'المسالك البولية'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }
    }
}
