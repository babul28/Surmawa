<?php

namespace App\Policies;

use App\Models\Lecture;
use App\Models\Survey;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Lecture  $lecture
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function view(Lecture $lecture, Survey $survey)
    {
        return (int) $lecture->id === (int) $survey->lecture_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Lecture  $lecture
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function update(Lecture $lecture, Survey $survey)
    {
        return (int) $lecture->id === (int) $survey->lecture_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Lecture  $lecture
     * @param  \App\Models\Survey  $survey
     * @return bool
     */
    public function delete(Lecture $lecture, Survey $survey)
    {
        return (int) $lecture->id === (int) $survey->lecture_id;
    }
}
