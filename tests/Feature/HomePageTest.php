<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_the_home_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_home_page_contains_app_name(): void
    {
        $response = $this->get('/');

        $response->assertSee(config('app.name'));
                // ->assertSee('Today')
                // ->assertSee('5 Day')
                // ->assertSee('Current Weather')
                // ->assertSee('Forecast for the next 12 hours');

        $response->assertStatus(200);
    }
}
