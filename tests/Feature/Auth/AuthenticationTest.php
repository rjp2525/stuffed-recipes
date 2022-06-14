<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Event;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Make sure we get a good status code when rendering the login page.
     */
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    /**
     * Ensure users can authenticate successfully.
     */
    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * Check that the authentication fails and displays an error if provided
     * with an invalid password.
     */
    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    /**
     * Checks that a user can logout and be redirected to the homepage.
     */
    public function test_users_can_logout_and_destroy_session()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))
            ->assertRedirect(route('homepage'));

        $this->assertGuest();
    }

    /**
     * Repeated failed login attempts get rate limited and account locked out.
     */
    public function test_excessive_login_attempts_get_rate_limited_and_locked_out()
    {
        $user = User::factory()->create();

        Event::fake();

        foreach (range(0, 4) as $attempt) {
            $this->post(route('login'), [
                'email' => $user->email,
                'password' => "wrong-password-{$attempt}"
            ])
            ->assertSessionHasErrors(['email' => __('auth.failed')]);
        }

        $start = Carbon::now();

        Carbon::setTestNow($start);

        $final_response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'another-wrong-password',
        ]);

        Event::assertDispatched(Lockout::class);

        $final_response->assertStatus(302)
            ->assertSessionHasErrors(['email' => __('auth.throttle', [
                'seconds' => Carbon::now()->addSeconds(60)->diffInSeconds($start)
            ])]);
    }

    /**
     * Check that a user is redirected to the login page when attempting to
     * access a secure page without being authenticated.
     */
    public function test_redirects_to_login_if_route_requires_authentication()
    {
        $this->assertGuest();

        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    /**
     * Redirect authenticated users to the route service provider home link when
     * attempting to access a guest-only route.
     */
    public function test_redirects_to_dashboard_if_authenticated_and_accessing_guest_route()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertStatus(302)
            ->assertRedirect(RouteServiceProvider::HOME);
    }
}
