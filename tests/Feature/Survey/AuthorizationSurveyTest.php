<?php

namespace Tests\Feature\Survey;

use App\Models\Lecture;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorizationSurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authorized_lecture_user_can_access_specified_survey_page()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->get('admin/surveys/' . $survey->id);

        $this->assertAuthenticatedAs($lecture);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_visit_edit_page_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->get('admin/surveys/' . $survey->id . '/edit');

        $this->assertAuthenticatedAs($lecture);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_update_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->put('admin/surveys/' . $survey->id, [
                'name' => 'Informatics',
                'departement_name' => 'Electriical Engineering Departement',
                'faculty_name' => 'Faculty of Engineering',
                'university_name' => 'State University of Malang',
                'expired_at' => Carbon::now()->addDays(5),
            ]);

        $this->assertAuthenticatedAs($lecture);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_destroy_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->delete('admin/surveys/' . $survey->id);

        $this->assertAuthenticatedAs($lecture);
        $response->assertForbidden();
    }
}
