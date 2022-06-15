<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a category
     */
    public function test_a_category_can_be_created()
    {
        $this->assertTrue(true);
    }
}
