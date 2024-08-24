<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollingController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/poll', [PollingController::class, 'poll']);

// Route::get('/test-ip', function () {
//     return 'whitelisted';


//     })->middleware('whitelisted');


Route::get('/index', [SessionController::class, 'getUserIp']);    
Route::post('/create', [SessionController::class, 'createSession']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
