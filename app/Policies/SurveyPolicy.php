<?php

namespace App\Policies;

use App\Models\Lecturer;
use App\Models\Survey;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function view(Lecturer $lecturer, Survey $survey)
    {
        return (int) $lecturer->id === (int) $survey->lecturer_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function update(Lecturer $lecturer, Survey $survey)
    {
        return (int) $lecturer->id === (int) $survey->lecturer_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function delete(Lecturer $lecturer, Survey $survey)
    {
        return (int) $lecturer->id === (int) $survey->lecturer_id;
    }
}
