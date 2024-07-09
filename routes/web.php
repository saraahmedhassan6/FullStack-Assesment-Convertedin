<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StatisticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Laravel Welcome intro to login
Route::get('/', function () {
    return view('welcome');
});

// Laravel Auth Routes
// Register route disabled
Auth::routes(['register' => false]);

// Auth Middleware to reach this routes
Route::middleware(['auth'])->group(function () {
    // use resources 
    // tasks --> get list of tasks 
    // tasks/create --> to let admin create task
    Route::resource('tasks', TaskController::class);
    // statistics --> get list of statistics counts of users 
    Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});

// home route after login to redirect depend on auth 
// admin --> route to create task
// user --> route to view list of tasks
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
