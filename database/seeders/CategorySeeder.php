<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'status' => 1],
            ['name' => 'Health', 'status' => 1],
            ['name' => 'Lifestyle', 'status' => 1],
            ['name' => 'Education', 'status' => 1],
            ['name' => 'Entertainment', 'status' => 1],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'status' => $category['status'],
            ]);
        }
    }
}
