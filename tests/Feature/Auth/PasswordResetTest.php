<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure we get a good response when rendering the password reset link page
     */
    public function test_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
    }

    /**
     * Make sure we can successfully request a password reset link and it sends
     * an email to the specified user
     */
    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('password.request'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    /**
     * Ensure a good response when rendering the reset screen and using a valid
     * reset token
     */
    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('password.request'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get(route('password.reset', $notification->token));

            $response->assertStatus(200);

            return true;
        });
    }

    /**
     * A password can be updated using a valid reset token
     */
    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('password.request'), ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post(route('password.update'), [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }

    /**
     * Ensures a validation exception is thrown when an invalid user email is
     * provided.
     */
    public function test_validation_exception_is_thrown_for_invalid_email()
    {
        $response = $this->post(route('password.request'), [
            'email' => 'wrong-email@example.com'
        ]);

        $response->assertSessionHasErrors(['email' => __('passwords.user')]);
    }

    /**
     * Check that a validation message is thrown on bad input
     */
    public function test_validation_message_is_shown_on_error()
    {
        $user = User::factory()->create();

        $response = $this->post(route('password.update', 'some-bad-token'), [
            'token' => 'some-bad-token',
            'email' => $user->email,
            'password' => 'SomeSuperSecurePassword123$',
            'password_confirmation' => 'SomeSuperSecurePassword123$'
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['email' => __('passwords.token')]);
    }
}
