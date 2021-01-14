<?php

use App\Http\Controllers\College\JoinSurveyController;
use App\Http\Controllers\College\SurveyBiodataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveysController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, '__invoke'])->name('college.home');
Route::post('/join', [JoinSurveyController::class, '__invoke'])->name('college.join.survey');
Route::get('/surveys/biodata', [SurveyBiodataController::class, '__invoke'])->name('college.survey.biodata');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->group(function () {
    require __DIR__ . '/auth.php';
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    // Surveys Endpoint
    Route::resource('/surveys', SurveysController::class);
});
