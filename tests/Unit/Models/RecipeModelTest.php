<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use App\Enums\RecipeDifficultyEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure the categories table has the correct columns
     *
     * @return void
     */
    public function test_recipes_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('recipes', [
            'id', 'author_id', 'category_id','forked_from', 'title', 'slug',
            'difficulty', 'description_short', 'description_long', 'directions',
            'notes', 'created_at', 'updated_at', 'deleted_at'
        ]), 1);
    }

    /**
     * Ensure the enums match the available database enum types.
     *
     * @return void
     */
    public function test_enums_match_difficulty_enum_field_values()
    {
        $easy = Recipe::factory()->create(['difficulty' => RecipeDifficultyEnum::EASY]);
        $this->assertEquals(RecipeDifficultyEnum::EASY, $easy->difficulty);

        $medium = Recipe::factory()->create(['difficulty' => RecipeDifficultyEnum::INTERMEDIATE]);
        $this->assertEquals(RecipeDifficultyEnum::INTERMEDIATE, $medium->difficulty);

        $hard = Recipe::factory()->create(['difficulty' => RecipeDifficultyEnum::DIFFICULT]);
        $this->assertEquals(RecipeDifficultyEnum::DIFFICULT, $hard->difficulty);
    }

    /**
     * Ensure the route key for the sluggable trait is the slug column.
     *
     * @return void
     */
    public function test_route_key_name_for_recipes_is_slug()
    {
        $cat = new Recipe;

        $this->assertEquals('slug', $cat->getRouteKeyName());
    }

    /**
     * Ensure a recipe can be created
     *
     * @return void
     */
    public function test_a_recipe_can_be_created()
    {
        $recipe = Recipe::factory()->create(['title' => 'Some Sample Recipe Name']);

        $this->assertDatabaseCount('recipes', 1)
            ->assertDatabaseHas('recipes', [
                'title' => $recipe->title,
            ]);
    }

    /**
     * Ensure the author to recipe relationship exists
     *
     * @return void
     */
    public function test_a_user_can_own_a_recipe()
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['author_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->recipes);
        $this->assertInstanceOf(User::class, $recipe->author);
        $this->assertTrue($user->recipes->contains($recipe));
        $this->assertEquals(1, $user->recipes->count());
    }

    /**
     * Ensure the forked recipe relationship is existent.
     *
     * @return void
     */
    public function test_a_recipe_can_have_forks()
    {
        $original = Recipe::factory()->create();
        $forked = Recipe::factory(3)->create(['forked_from' => $original->id]);

        $this->assertInstanceOf(Collection::class, $original->forks);
        $this->assertInstanceOf(Recipe::class, $forked->first()->original);
        $this->assertTrue($original->forks->contains($forked->first()));
        $this->assertEquals(3, $original->forks->count());
    }
}
