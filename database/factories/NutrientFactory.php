<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nutrient>
 */
class NutrientFactory extends Factory
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
            'name' => $this->faker->word(),
            'unit' => $this->faker->randomElement($units),
            'value' => $this->faker->randomFloat(2, 1, 150)
        ];
    }
}
