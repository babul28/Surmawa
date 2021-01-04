<?php

namespace Tests\Feature\Survey;

use App\Models\Lecturer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditSurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function edit_survey_screen_can_be_rendered()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->get('admin/surveys/' . $survey->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.edit');
        $response->assertViewHas('survey', $survey);
    }

    /** @test */
    public function only_authenticated_lecture_user_can_visit_edit_specified_survey_page()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $this->get('admin/surveys/' . $survey->id . '/edit')
            ->assertRedirect('/admin/login');
    }

    /** @test */
    public function an_lecture_user_can_edit_specified_survey()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $this->assertEquals('Informatics', $survey->name);
        $this->assertEquals('Electrical Engineering Department', $survey->department_name);
        $this->assertEquals('Faculty of Engineering', $survey->faculty_name);
        $this->assertEquals('State University of Malang', $survey->university_name);
        $this->assertEquals(Carbon::now()->addDays(5), $survey->expired_at);
    }

    /** @test */
    public function redirect_into_detail_survey_page_after_successfully_update_data()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $response->assertRedirect('admin/surveys/' . $survey->id);
    }

    /** @test */
    public function redirect_into_detail_survey_with_flash_message_page_after_successfully_update_data()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $response->assertRedirect('admin/surveys/' . $survey->id);
        $response->assertSessionHas('message');
    }

    /** @test */
    public function the_survey_name_field_is_required()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->name, Survey::first()->name);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_survey_department_name_field_is_required()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'department_name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->department_name, Survey::first()->department_name);
        $response->assertSessionHasErrors('department_name');
    }

    /** @test */
    public function the_survey_faculty_name_field_is_required()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'faculty_name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->faculty_name, Survey::first()->faculty_name);
        $response->assertSessionHasErrors('faculty_name');
    }

    /** @test */
    public function the_survey_university_name_field_is_required()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'university_name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->university_name, Survey::first()->university_name);
        $response->assertSessionHasErrors('university_name');
    }

    /** @test */
    public function the_survey_expired_at_field_is_required()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'expired_at' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->expired_at, Survey::first()->expired_at);
        $response->assertSessionHasErrors('expired_at');
    }

    /** @test */
    public function the_expired_at_field_is_date()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'expired_at' => 'ini bukan date'
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->expired_at, Survey::first()->expired_at);
        $response->assertSessionHasErrors('expired_at');
    }

    /**
     * Data for testing
     *
     * @return array
     */
    private function data(): array
    {
        return [
            'name' => 'Informatics',
            'department_name' => 'Electrical Engineering Department',
            'faculty_name' => 'Faculty of Engineering',
            'university_name' => 'State University of Malang',
            'expired_at' => Carbon::now()->addDays(5),
        ];
    }
}
