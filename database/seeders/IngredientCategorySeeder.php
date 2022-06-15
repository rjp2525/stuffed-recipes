<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Condiments',
                'description' => 'Substances such as salt or ketchup used to add flavor'
            ],
            [
                'name' => 'Fruits',
                'description' => ''
            ],
            [
                'name' => 'Vegetables',
                'description' => ''
            ],
            [
                'name' => 'Breakfast',
                'description' => ''
            ],
            [
                'name' => 'Meat',
                'description' => ''
            ],
            [
                'name' => 'Seafood',
                'description' => ''
            ],
            [
                'name' => 'Frozen',
                'description' => ''
            ],
            [
                'name' => 'Baby',
                'description' => ''
            ],
            [
                'name' => 'Pets',
                'description' => ''
            ],
            [
                'name' => 'Baking',
                'description' => ''
            ],
            [
                'name' => 'Snacks',
                'description' => ''
            ],
            [
                'name' => 'Bakery',
                'description' => ''
            ],
            [
                'name' => 'Pasta & Rice',
                'description' => ''
            ],
            [
                'name' => 'Cans & Jars',
                'description' => ''
            ],
            [
                'name' => 'Refrigerated',
                'description' => ''
            ],
            [
                'name' => 'Seasoning',
                'description' => ''
            ],
            [
                'name' => 'Sauces & Condiments',
                'description' => ''
            ],
            [
                'name' => 'Drinks',
                'description' => ''
            ],
            [
                'name' => 'General / Misc',
                'description' => ''
            ],
        ];
    }
}
