<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\MessagesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sendmessage',[MessagesController::class,'sendmessage']);
Route::post('/getallmessageswithuser',[MessagesController::class,'getallmessageswithuser']);
Route::post('/getconversations',[MessagesController::class,'getconversations']);

