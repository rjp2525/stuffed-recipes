<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_api_request_returns_correct_data_structure()
    {
        $response = $this->get(route('api.routes'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'url',
            'port',
            'defaults',
            'routes' => [
                '*' => [
                    'uri',
                    'methods'
                ]
            ]
        ]);
    }
}
