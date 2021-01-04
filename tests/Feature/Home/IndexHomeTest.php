<?php

namespace Tests\Feature\Home;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexHomeTest extends TestCase
{
    /** @test */
    public function index_home_render_page_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('college.home');
    }
}
