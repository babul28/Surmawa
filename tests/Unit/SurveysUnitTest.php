<?php

namespace Tests\Unit;

use App\Models\Lecture;
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
        $lecture = Lecture::factory()->create();

        $lecture->surveys()->create($this->data());

        $this->assertCount(1, Survey::all());
        $this->assertEquals($lecture->id, Survey::first()->lecture_id);
    }

    /** @test */
    public function a_lecture_can_get_list_of_the_survey_they_have()
    {
        $lecture = Lecture::factory()->create();

        $lecture->surveys()->create($this->data());
        $lecture->surveys()->create(array_merge($this->data(), [
            'name' => 'electrical'
        ]));

        $this->assertCount(2, Survey::all());
    }

    /** @test */
    public function a_lecture_can_get_details_of_specified_survey_by_id()
    {
        $lecture = Lecture::factory()->create();

        $survey = $lecture->surveys()->create($this->data());

        $result = Survey::where('id', $survey->id)
            ->where('lecture_id', $lecture->id)
            ->get();

        $this->assertCount(1, $result);
    }

    /** @test */
    public function a_lecture_can_get_all_active_surveys()
    {
        $lecture = Lecture::factory()->create();

        // jump to 5 hours into the future
        $this->travel(5)->hours();
        $lecture->surveys()->create($this->data());

        // jump to 10 days into the past
        $this->travel(-10)->days();
        $lecture->surveys()->create($this->data());

        // jump back to current time
        $this->travelBack();
        // jump to 5 days into the future
        $this->travel(5)->days();
        $lecture->surveys()->create($this->data());

        $this->travelBack();

        $surveys = Survey::where('lecture_id', $lecture->id)
            ->where('expired_at', '>=', Carbon::now())
            ->get();

        $this->assertCount(3, Survey::all());
        $this->assertCount(2, $surveys);
    }

    private function data(): array
    {
        return [
            'name' => 'informatics',
            'department_name' => 'Electrical Engineering Department',
            'faculty_name' => 'Faculty of Engineering',
            'university_name' => 'State University of Malang',
            'survey_code' => Str::random(6),
            'status' => 1,
            'expired_at' => Carbon::now(),
        ];
    }
}
