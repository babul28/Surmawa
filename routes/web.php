<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('/surveys', [SurveysController::class, 'index'])->name('surveys.index');
    Route::post('/surveys', [SurveysController::class, 'store'])->name('surveys.store');
    Route::get('/surveys/create', [SurveysController::class, 'create'])->name('surveys.create');
});
