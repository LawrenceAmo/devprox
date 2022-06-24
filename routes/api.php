<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\Test2Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/test2/random_user_info', [RecordsController::class, 'random_user_info'])->name("random_user");
Route::post('/test2/save_user_info', [RecordsController::class, 'save_user_info'])->name("save_user");
Route::get('/test2/get_curent_records', [Test2Controller::class, 'show']);

