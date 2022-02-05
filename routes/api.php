<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('/regist', [EventController::class, 'index']);

Route::group(['namespace'=>'API'], function() {
        
    Route::post('/regist', 'UsersController@regist');
    Route::post('/login', 'UsersController@login');
    Route::get('/schools', 'SchoolController@index');
    
    
    //Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'jwt.auth', 'jwt.refresh'], function() {
        Route::get('/profile'         , 'UsersController@profile');
        Route::post('/update/profile', 'UsersController@updateProfile');
        Route::get('/logout', 'UsersController@logout');
        Route::get('/exam', 'SchoolController@exam');
        

    });
});


