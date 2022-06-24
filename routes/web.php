<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\Test2Controller;

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
 
 
Route::get('/test1', [UserController::class, 'index']);
Route::post('/test1/create_user', [UserController::class, 'create_user'])->name("create_user");
Route::post('/test1/delete', [UserController::class, 'destroy_user'])->name("delete_user");

// //////////////////////////////////////

Route::get('/test2', [Test2Controller::class, 'index']);
Route::post('/test2/generate_users', [Test2Controller::class, 'create'])->name("create");
Route::post('/test2/download_csv_db', [Test2Controller::class, 'exportCSVDB'])->name("export_csv");
Route::get('/test2/delete_usersDB', [Test2Controller::class, 'destroy'])->name("destroy");


