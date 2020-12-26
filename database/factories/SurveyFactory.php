<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SurveyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Survey::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lecturer_id' => Lecturer::factory(),
            'name' => $this->faker->sentence,
            'departement_name' => $this->faker->sentence,
            'faculty_name' => $this->faker->sentence,
            'university_name' => $this->faker->sentence,
            'survey_code' => Str::random(6),
            'status' => 1,
            'expired_at' => Carbon::now()->addDays(5)
        ];
    }
}
