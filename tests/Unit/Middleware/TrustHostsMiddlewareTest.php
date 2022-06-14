<?php

namespace Tests\Unit\Middleware;

use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\TrustHosts;
use Illuminate\Support\Facades\Config;

class TrustHostsMiddlewareTest extends TestCase
{
    /**
     * Check that the TrustHosts middleware "hosts" method returns correct
     * pattern(s)
     *
     * NOTE: This does not run locally, see App\Http\Middleware\TrustHosts on
     *       line #56 - this middleware is not applied when running unit tests
     *       or when in a local environment.
     */
    public function test_trusted_hosts_middleware_allows_handling()
    {
        $host = parse_url(Config::get('app.url'), PHP_URL_HOST);
        $pattern = '^(.+\.)?'.preg_quote($host).'$';

        $request = Request::create(route('homepage'), 'GET');

        $middleware = new TrustHosts($this->app);

        $response = $middleware->handle($request, function () {
        });

        $this->assertEquals($response, null);
    }
}
