<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        Category::all()->each(function ($cat) use ($faker) {
            for ($i = 0; $i < 8; $i++) {
                Food::create([
                    'name'        => $name = ucfirst($faker->unique()->words(2, true)),
                    'slug'        => Str::slug($name . '-' . Str::random(4)), // đảm bảo unique
                    'description' => $faker->sentence(8),
                    'price'       => $faker->numberBetween(20000, 150000),
                    'image'       => 'assets/header_img.png',
                    'category_id' => $cat->id,
                ]);
            }
        });
    }
}
