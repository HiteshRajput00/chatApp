<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\UserDashboard\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('forms.index');
});

Route::Post('/login',[AuthenticationController::class,'login']);
Route::Post('/register',[AuthenticationController::class,'register']);

Route::get('/dashboard',[DashboardController::class,'index']);
Route::get('/chat-page',[ChatController::class,'chatPage']);

//::::::::::::::::::: chat routes ::::::::::::::::::::::::::::::://
Route::post('/send-message', [ChatController::class,'sendMessage']);
Route::get('/logout',[AuthenticationController::class,'logout']);
