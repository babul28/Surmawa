<?php

namespace Tests\Feature\Survey;

use App\Models\Lecturer;
use App\Models\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowSurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_survey_screen_can_be_rendered()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->get('admin/surveys/' . $survey->id);

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.show');
        $response->assertViewHas('survey', $survey);
    }

    /** @test */
    public function only_authenticated_lecture_user_can_visit_detail_page()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $this->get('admin/surveys/' . $survey->id)
            ->assertRedirect('/admin/login');
    }
}
