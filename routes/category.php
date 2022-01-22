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
use App\Http\Controllers\CategoriesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getallcategories',[CategoriesController::class,'index']);
Route::get('/getcategorybyid/{id}',[CategoriesController::class,'getcategorybyid']);
Route::get('/getproductsbycategory/{id}',[CategoriesController::class,'getproductsbycategory']);

Route::post('/addcategory',[CategoriesController::class,'addcategory']);
Route::post('/deletecategory/{id}',[CategoriesController::class,'deletecategory']);
Route::post('/updatecategory/{id}',[CategoriesController::class,'updatecategory']);
