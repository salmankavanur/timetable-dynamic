<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimetableController;

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

// Public Timetable Page
Route::get('/timetable', [TimetableController::class, 'index']);

// Redirect root to welcome or timetable
Route::get('/', function () {
    return view('welcome');
});

// Let Filament handle admin routes automatically, so no need for a custom /admin redirect
