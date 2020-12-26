<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SurveysController extends Controller
{

    private $lecturer;

    /**
     * constructor of SurveyController class
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->lecturer = Auth::user();
    }

    /**
     * Show list of surveys
     *
     * @return Illuminate/Http/Response
     */
    public function index()
    {
        return view('admin.surveys.index')
            ->with('surveys', $this->lecturer->surveys);
    }

    /**
     * Show specified survey
     *
     * @param Survey $survey
     * @return Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        // Checking authorization current user for
        // view this survey
        $this->authorize('view', $survey);

        return view('admin.surveys.show')
            ->with('survey', $survey);
    }

    /**
     * Show view for create new survey
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.surveys.create');
    }

    /**
     * Store new survey on databases
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = $this->lecturer->surveys()->create(
            array_merge($request->validate($this->rules()), [
                'survey_code' => Str::random(6),
                'status' => Survey::ACTIVE
            ])
        );

        return redirect()->route('admin.surveys.show', $survey->id)
            ->with('message', [
                'icon' => 'success',
                'message' => 'Successfully created new survey called ' . $survey->name . '!'
            ]);
    }

    /**
     * Show view for editing specified survey
     *
     * @param Survey $survey
     * @return Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        // Checking authorization current user for
        // updating this survey
        $this->authorize('update', $survey);

        return view('admin.surveys.edit')
            ->with('survey', $survey);
    }

    /**
     * Updating data from specified survey
     *
     * @param Request $request
     * @param Survey $survey
     * @return Illuminate\Support\Response
     */
    public function update(Request $request, Survey $survey)
    {
        // Checking authorization current user for
        // updating this survey
        $this->authorize('update', $survey);

        $survey->update($request->validate($this->rules()));

        return redirect()->route('admin.surveys.show', $survey->id)
            ->with('message', [
                'icon' => 'success',
                'message' => 'Successfully updating survey data!'
            ]);
    }

    /**
     * Destroy specified survey from databases
     *
     * @param Survey $survey
     * @return Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        // Checking authorization current user
        // to destroy this survey
        $this->authorize('delete', $survey);

        $survey->delete();

        return redirect()->route('admin.surveys.index')
            ->with('message', [
                'icon' => 'success',
                'message' => 'Successfully destroy survey called ' . $survey->name . '!'
            ]);
    }

    /**
     * Define rules for validating request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'departement_name' => 'required|string|max:255',
            'faculty_name' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'expired_at' => 'required|date',
        ];
    }
}
