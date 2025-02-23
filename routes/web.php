<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;


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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('projects', ProjectController::class)->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::prefix('projects/{project}')->group(function () {
        Route::resource('tasks', TaskController::class)
            ->parameters(['tasks' => 'task'])
            ->shallow(); // Important pour que les routes "tasks" soient imbriquées sous "projects"
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.page');
