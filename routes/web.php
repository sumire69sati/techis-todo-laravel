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
/**
 *  127.0.0.1:8000の後が
 * Route::get('/', function () の
 * /に当たる
 * 127.0.0.1:8000/welcomeに飛び
 * 127.0.0.1:8000/tasks' \Http\Controllers\TaskControllerのclassの中のindexに飛ぶ
 * 127.0.0.1:8000/task　\Http\Controllers\TaskControllerのclassの中のstoreに飛ぶ
 * 127.0.0.1:8000//task/{task}　\Http\Controllers\TaskControllerのclassの中のdestroyに飛ぶ
 *  */ 

// Route::[httpメソッド]([第一引数：URL],[第二引数：処理])
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
Route::post('/task', [App\Http\Controllers\TaskController::class, 'store'])->name('task');
Route::delete('/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('/task/{task}');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

