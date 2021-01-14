<?php

namespace Tests\Feature\Home;

use App\Models\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmitSurveyCodeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function college_student_can_submit_correct_survey_code()
    {
        $survey = Survey::factory()->create();

        $response = $this->post(route('college.join.survey'), [
            'survey_code' => str_split($survey->survey_code)
        ]);

        $response->assertRedirect();
    }

    /** @test */
    public function only_correct_survey_code_can_be_entered_by_college_student()
    {
        $response = $this->post(route('college.join.survey'), [
            'survey_code' => str_split('nik12g')
        ]);

        $response->assertSessionHasErrors('survey_code');
    }

    /** @test */
    public function field_survey_code_must_be_required()
    {
        $response = $this->post(route('college.join.survey'));

        $response->assertSessionHasErrors('survey_code');
    }

    /** @test */
    public function max_characters_survey_code_field_is_six()
    {
        $response = $this->post(route('college.join.survey'), [
            'survey_code' => str_split('nik12g12')
        ]);

        $response->assertSessionHasErrors('survey_code');
    }

    /** @test */
    public function survey_code_field_only_contains_alphanumerics()
    {
        $response = $this->post(route('college.join.survey'), [
            'survey_code' => str_split('hbhj`h')
        ]);

        $response->assertSessionHasErrors('survey_code');
    }

    /** @test */
    public function a_cookie_stored_on_browser_with_name_survey_code_after_successfully_join_survey()
    {
        $survey = Survey::factory()->create();

        $response = $this->post(route('college.join.survey'), [
            'survey_code' => str_split($survey->survey_code)
        ]);

        $response->assertRedirect(route('college.survey.biodata'));
        $response->assertCookie('survey_code');
    }
}
