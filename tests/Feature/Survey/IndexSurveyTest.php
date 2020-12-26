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
    }

    /** @test */
    public function only_an_authorized_user_can_access_survey_index_screen()
    {
        $response = $this->get('admin/surveys')
            ->assertRedirect('login');
    }

    /** @test */
    public function the_survey_data_provided_is_only_owned_by_authenticated_lecture_users()
    {
        $lecture = Lecture::factory()->create();
        Survey::factory()->create(['lecture_id' => $lecture->id]);
        Survey::factory()->create();
        Survey::factory()->create(['lecture_id' => $lecture->id]);
        Survey::factory()->create();

        $response = $this->actingAs($lecture)
            ->get('admin/surveys');

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.index');
        $this->assertCount(2, $lecture->surveys);
        $response->assertViewHas('surveys', $lecture->surveys);
    }
}
