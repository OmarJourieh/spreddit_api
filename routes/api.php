<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdmenController;
use App\Http\Controllers\MyFavorteController;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MessagesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('uploadphoto', 'AuthController@uploadphoto');
        Route::post('update', 'AuthController@update');
    }
);


Route::group(
[
    'middleware' => ['api', 'checkPassword'],
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth',
],
function ($router) {


});


Route::get('/getallusers',[Usercontroller::class,'getallusers']);
// Route::get('/getuserbyid',[Usercontroller::class,'getuserbyid']);

//product
Route::post('/updateproduct/{id}',[Productcontroller::class,'updateproduct']);
Route::post('/addproduct',[Productcontroller::class,'addproduct']);
Route::get('/getproductbyid/{id}',[Productcontroller::class,'getproductbyid']);
Route::get('/getallproducts',[Productcontroller::class,'getallproducts']);
Route::get('/getallproductsofuser/{id}',[Productcontroller::class,'getallproductsofuser']);
Route::get('/getownerofproduct/{id}',[Productcontroller::class,'getownerofproduct']);

Route::get('/deleteproduct/{id}',[Productcontroller::class,'deleteproduct']);


Route::post('/addtofavorite',[FavoritesController::class,'addtofavorite']);
Route::post('/deleteformfavorite',[FavoritesController::class,'deleteformfavorite']);
Route::get('/getallfavorites/{id}',[FavoritesController::class,'getallfavorites']);     //edited
Route::get('/getfavoritesids/{id}',[FavoritesController::class,'getfavoritesids']);     //edited

//new
Route::get('/markproductsold/{id}',[Productcontroller::class,'markproductsold']);



//category
Route::get('/getallcategories',[CategoriesController::class,'index']);
Route::get('/getcategorybyid/{id}',[CategoriesController::class,'getcategorybyid']);
Route::get('/getproductsbycategory/{id}',[CategoriesController::class,'getproductsbycategory']);

Route::post('/addcategory',[CategoriesController::class,'addcategory']);
Route::post('/deletecategory/{id}',[CategoriesController::class,'deletecategory']);
Route::post('/updatecategory/{id}',[CategoriesController::class,'updatecategory']);



//user
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

//message
Route::post('/sendmessage',[MessagesController::class,'sendmessage']);
Route::post('/getallmessageswithuser',[MessagesController::class,'getallmessageswithuser']);
Route::post('/getconversations',[MessagesController::class,'getconversations']);
Route::post('/blockuser',[Usercontroller::class,'blockuser']);
Route::post('/getalluserblockedbyme',[Usercontroller::class,'getalluserblockedbyme']);
Route::post('/unblockuser',[Usercontroller::class,'unblockuser']);

