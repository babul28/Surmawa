<?php

namespace Tests\Feature\Survey;

use App\Models\Lecturer;
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

        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->get('admin/surveys/' . $survey->id);

        $this->assertAuthenticatedAs($lecturer);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_visit_edit_page_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->get('admin/surveys/' . $survey->id . '/edit');

        $this->assertAuthenticatedAs($lecturer);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_update_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->put('admin/surveys/' . $survey->id, [
                'name' => 'Informatics',
                'department_name' => 'Electrical Engineering Department',
                'faculty_name' => 'Faculty of Engineering',
                'university_name' => 'State University of Malang',
                'expired_at' => Carbon::now()->addDays(5),
            ]);

        $this->assertAuthenticatedAs($lecturer);
        $response->assertForbidden();
    }

    /** @test */
    public function only_authorized_lecture_user_can_destroy_specified_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->delete('admin/surveys/' . $survey->id);

        $this->assertAuthenticatedAs($lecturer);
        $response->assertForbidden();
    }
}
