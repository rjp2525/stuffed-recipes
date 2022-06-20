<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $units = ['doz', 'oz', 'gal', 'in', 'lb', 'pt', 'qt', 'tbsp', 'tsp',
                  'cup', 'cm', 'kl', 'l', 'mg', 'ml', 'mm', 'g'];
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'brand' => $this->faker->word(),
            'upc' => $this->faker->ean13(),
            'serving_size' => rand(1, 100),
            'serving_size_unit' => $this->faker->randomElement($units)
        ];
    }
}
