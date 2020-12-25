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
    // Surveys Endpoint
    Route::group([
        'prefix' => '/surveys',
        'as' => 'surveys.'
    ], function () {
        Route::get('/', [SurveysController::class, 'index'])->name('index');
        Route::post('/', [SurveysController::class, 'store'])->name('store');
        Route::get('/create', [SurveysController::class, 'create'])->name('create');
        Route::get('/{survey}/edit', [SurveysController::class, 'edit'])->name('edit');
        Route::put('/{survey}', [SurveysController::class, 'update'])->name('update');
        Route::delete('/{survey}', [SurveysController::class, 'destroy'])->name('destroy');
    });
});
