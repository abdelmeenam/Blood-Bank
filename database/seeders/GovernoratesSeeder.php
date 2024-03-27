<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            ['name' => 'القاهرة'],
            ['name' => 'الإسكندرية'],
            ['name' => 'الجيزة'],
            ['name' => 'الدقهلية'],
            ['name' => 'البحر الأحمر'],
            ['name' => 'البحيرة'],
            ['name' => 'الفيوم'],
            ['name' => 'الغربية'],
            ['name' => 'الإسماعيلية'],
            ['name' => 'المنوفية'],
            ['name' => 'المنيا'],
            ['name' => 'القليوبية'],
            ['name' => 'الوادي الجديد'],
            ['name' => 'السويس'],
            ['name' => 'اسوان'],
            ['name' => 'أسيوط'],
            ['name' => 'بني سويف'],
            ['name' => 'بورسعيد'],
            ['name' => 'دمياط'],
            ['name' => 'الشرقية'],
            ['name' => 'جنوب سيناء'],
            ['name' => 'كفر الشيخ'],
            ['name' => 'مطروح'],
            ['name' => 'الأقصر'],
            ['name' => 'قنا'],
            ['name' => 'شمال سيناء'],
            ['name' => 'سوهاج'],
        ];

        DB::table('governorates')->insert($governorates);
    }
}