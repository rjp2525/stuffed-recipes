<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Mockery;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure the categories table has the correct columns
     *
     * @return void
     */
    public function test_categories_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('categories', [
            'id', 'name', 'description', 'parent_id', 'author_id', 'created_at',
            'updated_at', 'deleted_at'
        ]), 1);
    }

    /**
     * Create a category
     */
    public function test_a_category_can_be_created()
    {
        $category = Category::create([
            'name' => 'Testing',
            'description' => 'Testing Category Description'
        ]);

        $this->assertDatabaseCount('categories', 1)
            ->assertDatabaseHas('categories', [
                'name' => $category->name,
                'description' => $category->description
            ]);
    }

    /**
     * Ensure the author to category relationship exists
     *
     * @return void
     */
    public function test_a_user_can_own_a_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['author_id' => $user->id]);

        $this->assertInstanceOf(Collection::class, $user->categories);
        $this->assertInstanceOf(User::class, $category->author);
        $this->assertTrue($user->categories->contains($category));
        $this->assertEquals(1, $user->categories->count());
    }

    /**
     * Ensure a category can have a child/subcategory
     *
     * @return void
     */
    public function test_a_category_can_have_a_parent_category()
    {
        $category = Category::factory()->create();
        $subcategory = Category::factory()->create(['parent_id' => $category->id]);

        $this->assertInstanceOf(Collection::class, $category->children);
        $this->assertInstanceOf(Category::class, $subcategory->parent);
        $this->assertTrue($category->children->contains($subcategory));
        $this->assertEquals($subcategory->parent->id, $category->id);
        $this->assertEquals(1, $category->children->count());
    }
    
    /**
     * Ensure the route key for the sluggable trait is the slug column.
     *
     * @return void
     */
    public function test_route_key_name_for_categories_is_slug()
    {
        $cat = new Category;

        $this->assertEquals('slug', $cat->getRouteKeyName());
    }
}
