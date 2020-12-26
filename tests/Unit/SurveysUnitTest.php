<?php

namespace Tests\Unit;

use App\Models\Lecturer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SurveysUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_lecture_can_create_new_survey()
    {
        $lecturer = Lecturer::factory()->create();

        $lecturer->surveys()->create($this->data());

        $this->assertCount(1, Survey::all());
        $this->assertEquals($lecturer->id, Survey::first()->lecturer_id);
    }

    /** @test */
    public function a_lecture_can_get_list_of_the_survey_they_have()
    {
        $lecturer = Lecturer::factory()->create();

        $lecturer->surveys()->create($this->data());
        $lecturer->surveys()->create(array_merge($this->data(), [
            'name' => 'electrical'
        ]));

        $this->assertCount(2, Survey::all());
    }

    /** @test */
    public function a_lecture_can_get_details_of_specified_survey_by_id()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = $lecturer->surveys()->create($this->data());

        $result = Survey::where('id', $survey->id)
            ->where('lecturer_id', $lecturer->id)
            ->get();

        $this->assertCount(1, $result);
    }

    /** @test */
    public function a_lecture_can_get_all_active_surveys()
    {
        $lecturer = Lecturer::factory()->create();

        // jump to 5 hours into the future
        $this->travel(5)->hours();
        $lecturer->surveys()->create($this->data());

        // jump to 10 days into the past
        $this->travel(-10)->days();
        $lecturer->surveys()->create($this->data());

        // jump back to current time
        $this->travelBack();
        // jump to 5 days into the future
        $this->travel(5)->days();
        $lecturer->surveys()->create($this->data());

        $this->travelBack();

        $surveys = Survey::where('lecturer_id', $lecturer->id)
            ->where('expired_at', '>=', Carbon::now())
            ->get();

        $this->assertCount(3, Survey::all());
        $this->assertCount(2, $surveys);
    }

    private function data()
    {
        return [
            'name' => 'informatics',
            'departement_name' => 'Electriical Engineering Departement',
            'faculty_name' => 'Faculty of Engineering',
            'university_name' => 'State University of Malang',
            'survey_code' => Str::random(6),
            'status' => 1,
            'expired_at' => Carbon::now(),
        ];
    }
}
