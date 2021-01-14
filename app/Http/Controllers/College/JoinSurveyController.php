<?php

namespace App\Http\Controllers\College;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class JoinSurveyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'survey_code.*' => [
                'required',
                'regex:/[A-Za-z0-9]/',
            ],
            'survey_code' => [
                'required',
                'array',
                'min:6',
                'max:6',
                function ($attribute, array $value, $fail) {
                    if (!Survey::where('survey_code', join($value))
                        ->first()) {
                        $fail('The Survey Code is not exists on the databases');
                    }
                }
            ],
        ]);

        return redirect()
            ->route('college.survey.biodata')
            ->cookie(cookie(
                'survey_code',
                encrypt(join($request->survey_code)),
                60 * 60
            ));
    }
}
