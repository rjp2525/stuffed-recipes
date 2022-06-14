<?php

namespace Tests\Unit\Traits;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsesUuidsTraitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that users have a UUID for the primary key.
     */
    public function test_user_models_have_uuid_for_primary_id()
    {
        $user = User::factory()->create();

        $this->assertTrue(isset($user->id));
        // Assert that the key type is a string and not integer
        $this->assertEquals('string', $user->getModel()->getKeyType());
    }
}
