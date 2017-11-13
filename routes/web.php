<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//grupo de rutas cubiertas por el middleware checklogin
Route::group(['middleware'=>['checkLogin'],],function(){
	Route::get('/','PagesController@dashboard')->name('dashboard');


	/*Grupo de rutas con pefijo 'admin'*/
	Route::group(['prefix'=>'admin'],function(){
		
		/*Grupo de rutas con pefijo 'admin/usuarios'*/
		Route::group(['prefix'=>'usuarios','middleware'=>['permission:crear_usuarios|modificar_usuarios|ver_usuarios|eliminar_usuarios']],function(){
			Route::get('/','AdminController@users_index')->name('admin_users_index');	
			Route::get('nuevo','AdminController@new_user_form')->name('new_user_form');
			Route::post('nuevo','AdminController@create_new_user');

			Route::get('{id}/detalles','AdminController@show_user_details')->name('show_user_details');
			Route::get('{id}/editar', 'AdminController@edit_user_form')->name('edit_user_form');
			Route::get('{id}/roles', 'AdminController@edit_user_roles_form')->name('edit_user_roles_form');
			Route::post('{id}/roles', 'AdminController@edit_user_roles')->name('edit_user_roles');
			Route::post('/editar','AdminController@update_user')->name('post_update_user');
		});

		Route::group(['prefix'=>'rolesYpermisos','middleware'=>['role:administrador']],function(){
			Route::get('/','AdminController@roles_permissions_index')->name('roles_permissions_index');
			Route::post('/nuevoRol',"AdminController@create_new_role")->name('post_new_role');
			Route::post('/guardarPermisos','AdminController@save_permissions')->name('save_permissions');
			Route::get('{id}/','AdminController@delete_user')->name('delete_user');

			Route::get('role/{id}/delete','AdminController@delete_role')->name('delete_role');
		});
	});	

	Route::group(['prefix'=>'pacientes'],function(){
		Route::get('/','PatientsController@index')->name('patients_index');
		Route::get('/{id}/detalles','PatientsController@show_details')->name('patient_detail');
		Route::get('/nuevo','PatientsController@new_patient_form')->name('new_patient_form');
		Route::post('/nuevo','PatientsController@register_new_patient')->name('post_new_patient');
		
		Route::get('/buscar','PatientsController@patients_search')->name('patients_search');
	});

	Route::group(['prefix'=>'test'],function(){
		Route::get('/api1',function(){return view('test.api1');});
	});

});
Route::get('/test/api',function(){
	return view('test.api1');
});