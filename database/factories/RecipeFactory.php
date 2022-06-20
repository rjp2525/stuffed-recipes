<?php

namespace Database\Factories;

use App\Enums\RecipeDifficultyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $prep_time = rand(60, 5400);
        $cook_time = rand(60, 5400);
        $custom_time = rand(0, 5400);
        $total_time = $prep_time + $cook_time + $custom_time;
        $difficulties = [
            RecipeDifficultyEnum::EASY,
            RecipeDifficultyEnum::INTERMEDIATE,
            RecipeDifficultyEnum::DIFFICULT,
        ];

        return [
            'title' => $this->faker->sentence,
            'description_short' => $this->faker->sentences(rand(1, 3), true),
            'description_long' => $this->faker->paragraphs(rand(1, 3), true),
            'notes' => $this->faker->paragraphs(rand(0, 3), true),
            'directions' => $this->faker->paragraphs(rand(3, 10), true),
            'prep_time' => $prep_time,
            'cook_time' => $cook_time,
            'custom_time' => $custom_time,
            'custom_time_label' => $custom_time ?: $this->faker->word.' time',
            'total_time' => $total_time,
            'servings' => rand(1, 12),
            'yield' => rand(1, 40).' '.$this->faker->word,
            'difficulty' => $this->faker->randomElement($difficulties),
        ];
    }
}
