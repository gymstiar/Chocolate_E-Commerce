<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Dark Chocolate',
                'slug' => 'dark-chocolate',
                'description' => 'Rich, intense dark chocolate with high cocoa content. Perfect for true chocolate connoisseurs.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Milk Chocolate',
                'slug' => 'milk-chocolate',
                'description' => 'Smooth and creamy milk chocolate. A classic favorite for all ages.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'White Chocolate',
                'slug' => 'white-chocolate',
                'description' => 'Sweet and velvety white chocolate made from cocoa butter.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Ruby Chocolate',
                'slug' => 'ruby-chocolate',
                'description' => 'The fourth type of chocolate with a naturally pink color and berry-like flavor.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Truffles',
                'slug' => 'truffles',
                'description' => 'Luxurious chocolate truffles with various fillings and coatings.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Pralines',
                'slug' => 'pralines',
                'description' => 'Belgian-style pralines with creamy centers and exquisite designs.',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Chocolate Bars',
                'slug' => 'chocolate-bars',
                'description' => 'Premium chocolate bars in various flavors and cocoa percentages.',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Gift Boxes',
                'slug' => 'gift-boxes',
                'description' => 'Beautifully packaged chocolate gift boxes for special occasions.',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Hot Chocolate',
                'slug' => 'hot-chocolate',
                'description' => 'Premium hot chocolate mixes and drinking chocolate.',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Sugar-Free',
                'slug' => 'sugar-free',
                'description' => 'Delicious sugar-free chocolate options for health-conscious customers.',
                'is_active' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
