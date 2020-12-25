<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SurveysController extends Controller
{

    private $lecture;

    /**
     * constructor of SurveyController class
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->lecture = Auth::user();
    }

    /**
     * Show list of surveys
     *
     * @return Illuminate/Http/Response
     */
    public function index()
    {
        return view('admin.surveys.index')
            ->with('surveys', Survey::all());
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'departement_name' => 'required|string|max:255',
            'faculty_name' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'expired_at' => 'required|date',
        ]);

        $survey = $this->lecture->surveys()->create(
            array_merge($data, [
                'survey_code' => Str::random(6),
                'status' => Survey::ACTIVE
            ])
        );

        return redirect('admin/surveys/' . $survey->id)
            ->with('message', [
                'icon' => 'success',
                'message' => 'Successfully created new survey called ' . $survey->name . '!'
            ]);
    }
}
