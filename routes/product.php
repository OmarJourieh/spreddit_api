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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware(['cors'])->group(function () {
//     Route::post('/hogehoge', 'Controller@hogehoge');

    Route::post('/updateproduct/{id}',[Productcontroller::class,'updateproduct']);
    Route::post('/addproduct',[Productcontroller::class,'addproduct']);
    Route::get('/getproductbyid/{id}',[Productcontroller::class,'getproductbyid']);
    Route::get('/getallproducts',[Productcontroller::class,'getallproducts']);
    Route::get('/getallproductsofuser/{id}',[Productcontroller::class,'getallproductsofuser']);
    Route::get('/getownerofproduct/{id}',[Productcontroller::class,'getownerofproduct']);
    
    
// });

 