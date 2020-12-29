<?php

namespace Tests\Feature\Survey;

use App\Models\Lecturer;
use App\Models\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroySurveyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_lecture_user_can_destroy_specified_survey()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->delete('admin/surveys/' . $survey->id);

        $this->assertCount(0, Survey::all());
    }

    /** @test */
    public function only_authenticated_lecture_user_can_destroy_specified_survey()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->delete('admin/surveys/' . $survey->id);

        $response->assertRedirect('login');
        $this->assertCount(1, Survey::all());
    }

    /** @test */
    public function redirect_to_surveys_index_page_after_successfully_delete_page()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->delete('admin/surveys/' . $survey->id);

        $this->assertCount(0, Survey::all());
        $response->assertRedirect('admin/surveys');
    }

    /** @test */
    public function redirect_to_surveys_index_page_with_flash_message_after_successfully_delete_page()
    {
        $lecturer = Lecturer::factory()->create();

        $survey = Survey::factory()->create([
            'lecturer_id' => $lecturer->id
        ]);

        $response = $this->actingAs($lecturer)
            ->delete('admin/surveys/' . $survey->id);

        $this->assertCount(0, Survey::all());
        $response->assertRedirect('admin/surveys');
        $response->assertSessionHas('message');
    }
}
