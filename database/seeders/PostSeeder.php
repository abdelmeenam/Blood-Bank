<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('ar_SA'); // Use Arabic locale

        // Define medical categories IDs
        $categoryIds = range(2, 11); // Assuming you have 10 categories

        // Loop to generate fake medical posts
        for ($i = 0; $i < 10; $i++) { // Generate 50 posts
            $title = $faker->sentence();
            $image = $faker->imageUrl();
            $content = $faker->realText(1000); // Generate Arabic medical content with 1000 characters
            $categoryId = $faker->randomElement($categoryIds);

            Post::create([
                'title' => $title,
                'image' => $image,
                'content' => $content,
                'category_id' => $categoryId,
            ]);
        }
    }
}
