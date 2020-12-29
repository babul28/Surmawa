<?php

namespace Tests\Feature;

use App\Models\Lecturer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'university' => 'State University of Malang',
            'faculty' => 'Faculty of Engineering',
            'department' => 'Informatics Engineering Department',
        ]);

        $this->assertAuthenticated();
        $this->assertCount(1, Lecturer::all());
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
