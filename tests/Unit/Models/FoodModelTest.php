<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Food;
use App\Models\Nutrient;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FoodModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure the food table has the correct columns
     *
     * @return void
     */
    public function test_food_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('food', [
            'id', 'name', 'description', 'brand', 'slug', 'upc', 'serving_size',
            'serving_size_unit', 'created_at', 'updated_at', 'deleted_at'
        ]), 1);
    }

    /**
     * Ensure a food record can be created.
     *
     * @return void
     */
    public function test_food_record_can_be_created()
    {
        $food = Food::factory()->create(['name' => 'Test Food']);

        $this->assertDatabaseCount('food', 1);
        $this->assertDatabaseHas('food', [
            'name' => $food->name
        ]);
    }

    /**
     * Ensure the route key for the sluggable trait is the slug column.
     *
     * @return void
     */
    public function test_route_key_name_for_food_is_slug()
    {
        $cat = new Food;

        $this->assertEquals('slug', $cat->getRouteKeyName());
    }

    /**
     * Ensure that a food can have nutrients attached to it and the inverse.
     *
     * @return void
     */
    public function test_food_can_have_many_nutrients()
    {
        $food = Food::factory()->create();
        $nutrients = Nutrient::factory(5)->create(['food_id' => $food->id]);

        $this->assertInstanceOf(Collection::class, $food->nutrients);
        $this->assertInstanceOf(Food::class, $nutrients->first()->food);
        $this->assertTrue($food->nutrients->contains($nutrients->first()));
        $this->assertEquals(5, $food->nutrients->count());
    }

    /**
     * Ensure that a food can have an owner (user account)
     *
     * @return void
     */
    public function test_food_can_have_an_owner()
    {
        $user = User::factory()->create();
        $food = Food::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->foods);
        $this->assertInstanceOf(User::class, $food->addedBy);
        $this->assertTrue($user->foods->contains($food));
        $this->assertEquals(1, $user->foods->count());
    }
}
