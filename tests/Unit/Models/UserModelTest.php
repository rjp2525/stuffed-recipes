<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure we can retrieve settings for a user.
     *
     * @return void
     */
    public function test_user_settings_can_be_retrieved()
    {
        $settings = ["settings" => ["foo" => "bar"]];

        $user = User::factory()->create($settings);

        $this->assertEquals("bar", $user->setting("foo"));
        $this->assertNull($user->setting("baz"));
        $this->assertEquals(5, $user->setting("baz", 5));
    }

    /**
     * Ensure settings can be updated.
     *
     * @return void
     */
    public function test_user_settings_can_be_modified()
    {
        $settings = ["settings" => ["foo" => "bar"]];

        $user = User::factory()->create($settings);

        $this->assertEquals(
            "world",
            $user->settings(["foo" => "world"], false)->setting("foo")
        );

        $this->assertEquals(
            "hello",
            $user->settings(["baz" => "hello"], false)->setting("baz")
        );

        $this->assertEquals(
            ["foo" => "bar"],
            $user->refresh()->settings
        );
    }

    /**
     * Ensure user settings can be changed and saved.
     *
     * @return void
     */
    public function test_user_settings_can_be_changed_and_saved()
    {
        $settings = ["settings" => ["foo" => "bar"]];

        $user = User::factory()->create($settings);

        $this->assertEquals(
            "world",
            $user->settings(["foo" => "world"])->setting("foo")
        );

        $this->assertEquals(
            ["foo" => "world"],
            $user->refresh()->settings
        );
    }
}
