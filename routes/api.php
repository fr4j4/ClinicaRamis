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

Route::get('/token','ApiController@show_token');

//Route::get('/role/{id}/setname/{name}','ApiController@setRoleName')->name('api_change_role_name');

/*
Route::group(['middleware' => ['apiTokenChecker']],function(){
	
});
*/
Route::post('/setRoleName','ApiController@setRoleName')->name('api_change_role_name');
Route::post('/updateRoles','ApiController@updateRoles')->name('update_roles');

Route::get('/doctorsList','ApiController@get_doctors_list')->name('api_get_doctors_list');
Route::get('/assistaintsList','ApiController@get_assistaints_list')->name('api_get_assistaints_list');
Route::get('/patientsList','ApiController@get_patients_list')->name('api_get_patients_list');

Route::get('/test','ApiController@test')->name('test_api');

Route::get('agenda/events/get','ApiController@get_agenda_events')->name('api_agenda_events');
