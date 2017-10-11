<?php

use Illuminate\Http\Request;

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

Route::get('/role/{id}/setname/{name}','ApiController@setRoleName')->name('api_change_role_name');

/*
Route::group(['middleware' => ['apiTokenChecker']],function(){
	
});
*/

Route::post('/updateRoles','ApiController@updateRoles')->name('update_roles');

Route::get('/test','ApiController@test')->name('test_api');
