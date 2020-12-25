<?php

namespace Tests\Feature\Survey;

use App\Models\Lecture;
use App\Models\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexSurveyTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function survey_index_screen_can_be_rendered()
    {
        $response = $this->actingAs(Lecture::factory()->create())
            ->get('admin/surveys');

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.index');
        $response->assertViewHas('surveys', Survey::all());
    }

    /** @test */
    public function only_an_authorized_user_can_access_survey_index_screen()
    {
        $response = $this->get('admin/surveys')
            ->assertRedirect('login');
    }
}
