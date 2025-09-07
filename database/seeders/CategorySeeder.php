<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Món nước',   'description' => 'Các món phở, bún, mì', 'image' => 'assets/header_img.png'],
            ['name' => 'Cơm',        'description' => 'Cơm phần, cơm đĩa',     'image' => 'assets/header_img.png'],
            ['name' => 'Đồ nướng',   'description' => 'Nướng than, BBQ',       'image' => 'assets/header_img.png'],
            ['name' => 'Ăn vặt',     'description' => 'Snack, quà vặt',        'image' => 'assets/header_img.png'],
            ['name' => 'Đồ uống',    'description' => 'Cà phê, trà, sinh tố',  'image' => 'assets/header_img.png'],
        ];

       

        foreach ($items as $it) {
            Category::updateOrCreate(
                ['name' => $it['name']],
                [
                    'slug' => Str::slug($it['name']),
                    'description' => $it['description'],
                    'image' => $it['image'],
                ]
            );
        }
    }
}