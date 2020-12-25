<?php

namespace Tests\Feature\Survey;

use App\Models\Lecture;
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
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture)
            ->get('admin/surveys/' . $lecture->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.surveys.edit');
        $response->assertViewHas('survey', $survey);
    }

    /** @test */
    public function only_authorized_lecture_user_can_visit_edit_specified_survey_page()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $this->get('admin/surveys/' . $lecture->id . '/edit')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_lecture_user_can_edit_specified_survey()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $this->actingAs($lecture)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $this->assertEquals('Informatics', $survey->name);
        $this->assertEquals('Electriical Engineering Departement', $survey->departement_name);
        $this->assertEquals('Faculty of Engineering', $survey->faculty_name);
        $this->assertEquals('State University of Malang', $survey->university_name);
        $this->assertEquals(Carbon::now()->addDays(5), $survey->expired_at);
    }

    /** @test */
    public function redirect_into_detail_survey_page_after_successfully_update_data()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $response->assertRedirect('admin/surveys/' . $survey->id);
    }

    /** @test */
    public function redirect_into_detail_survey_with_flash_message_page_after_successfully_update_data()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture)
            ->put('admin/surveys/' . $survey->id, $this->data());

        $survey = Survey::first();

        $this->assertCount(1, Survey::all());
        $response->assertRedirect('admin/surveys/' . $survey->id);
        $response->assertSessionHas('message');
    }

    /** @test */
    public function the_survey_name_field_is_required()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->name, Survey::first()->name);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_survey_departement_name_field_is_required()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'departement_name' => ''
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->departement_name, Survey::first()->departement_name);
        $response->assertSessionHasErrors('departement_name');
    }

    /** @test */
    public function the_survey_faculty_name_field_is_required()
    {
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
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
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
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
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
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
        $lecture = Lecture::factory()->create();

        $survey = Survey::factory()->create([
            'lecture_id' => $lecture->id
        ]);

        $response = $this->actingAs($lecture = Lecture::factory()->create())
            ->put('admin/surveys/' . $survey->id, array_merge($this->data(), [
                'expired_at' => 'ini bukan date'
            ]));

        $this->assertCount(1, Survey::all());
        $this->assertEquals($survey->expired_at, Survey::first()->expired_at);
        $response->assertSessionHasErrors('expired_at');
    }

    private function data()
    {
        return [
            'name' => 'Informatics',
            'departement_name' => 'Electriical Engineering Departement',
            'faculty_name' => 'Faculty of Engineering',
            'university_name' => 'State University of Malang',
            'expired_at' => Carbon::now()->addDays(5),
        ];
    }
}
