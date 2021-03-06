<?php

namespace Tests\Feature\Survey;

use App\Models\Lecturer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_survey_screen_can_be_rendered()
    {
        $response = $this->actingAs(Lecturer::factory()->create())
            ->get('admin/surveys/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.create');
    }

    /** @test */
    public function only_an_authenticated_lecture_user_can_visit_create_new_survey_screen()
    {
        $this->get('admin/surveys/create')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function an_lecture_user_can_create_new_survey()
    {
        $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $this->assertEquals($lecturer->id, $survey->lecturer_id);
    }

    /** @test */
    public function redirect_to_specified_survey_detail_with_flash_message_page_after_successfully_created_new_survey()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $this->assertEquals($lecturer->id, $survey->lecturer_id);
        $response->assertRedirect('admin/surveys/' . $survey->id);
    }

    /** @test */
    public function redirect_with_contains_flash_message_after_successfully_created_new_survey()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $this->assertEquals($lecturer->id, $survey->lecturer_id);
        $response->assertSessionHas('message');
    }

    /** @test */
    public function only_an_authenticated_lecture_user_can_create_new_survey()
    {
        $response = $this->post('admin/surveys', $this->data())
            ->assertRedirect('/admin/login');

        $this->assertCount(0, Survey::all());
    }


    /** @test */
    public function the_survey_name_field_is_required()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'name' => ''
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_department_name_field_is_required()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'department_name' => ''
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('department_name');
    }

    /** @test */
    public function the_faculty_name_field_is_required()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'faculty_name' => ''
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('faculty_name');
    }

    /** @test */
    public function the_university_name_field_is_required()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'university_name' => ''
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('university_name');
    }

    /** @test */
    public function the_expired_at_field_is_required()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'expired_at' => ''
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('expired_at');
    }

    /** @test */
    public function the_expired_at_field_is_date()
    {
        $response = $this->actingAs($lecturer = Lecturer::factory()->create())
            ->post('admin/surveys', array_merge($this->data(), [
                'expired_at' => 'aslkdlsakl'
            ]));

        $this->assertCount(0, Survey::all());
        $response->assertSessionHasErrors('expired_at');
    }

    private function data()
    {
        return [
            'name' => 'informatics',
            'department_name' => 'Electrical Engineering Department',
            'faculty_name' => 'Faculty of Engineering',
            'university_name' => 'State University of Malang',
            'expired_at' => Carbon::now(),
        ];
    }
}
