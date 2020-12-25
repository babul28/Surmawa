<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SurveysController extends Controller
{

    /**
     * constructor of SurveyController class
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
}
