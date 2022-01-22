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
use App\Http\Middleware\r;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['Middleware'=>'r'],function(){
    Route::post('/adduser',[Usercontroller::class,'adduser']);
Route::post('/updatedatauser/{id}',[Usercontroller::class,'updatedatauser']);
Route::get('/getuserbyid/{id}',[Usercontroller::class,'getuserbyid']);
Route::get('/getallusers',[Usercontroller::class,'getallusers']);
Route::post('/deleteuser/{id}',[Usercontroller::class,'deleteuser']);
Route::post('/login',[Usercontroller::class,'login']);
Route::get('/r',function(Request $request){
    echo "any thing";
})->middleware(r::class);

Route::post('/rateuser',[Usercontroller::class,'rateuser']);
Route::post('/getgivenrate',[Usercontroller::class,'getgivenrate']);
Route::post('/getaveragerate',[Usercontroller::class,'getaveragerate']);



 