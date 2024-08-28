<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-task', [App\Http\Controllers\HomeController::class, 'addtask'])->name('add-task');
Route::post('/status', [App\Http\Controllers\HomeController::class, 'statusupdate'])->name('status');
Route::post('/task-delete', [App\Http\Controllers\HomeController::class, 'taskdelete'])->name('delete');
Route::post('/get-list-task', [App\Http\Controllers\HomeController::class, 'gettasklist'])->name('gettasklist');
