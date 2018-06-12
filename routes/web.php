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

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::get('/register', function () {
	//return view('welcome');
	return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/permissions', 'AclController@permissions');

Route::get('/permissions/create', 'AclController@create_permissions');

Route::post('/permissions/store', 'AclController@store_permissions');

Route::get('/roles', 'AclController@roles');

Route::get('/roles/create', 'AclController@create_roles');

Route::get('/roles/edit/{id_role}', 'AclController@edit_roles');

Route::post('/roles/store', 'AclController@store_roles');

Route::get('/roles/destroy/{id_role}', 'AclController@destroy_roles');

Route::get('/users', 'UsersController@users');

Route::get('/users/create', 'UsersController@create');

Route::get('/users/edit/{id_user}', 'UsersController@edit');

Route::post('/users/store', 'UsersController@store');

Route::get('/users/destroy/{id_user}', 'UsersController@destroy');

Route::get('/audit', 'AclController@audit');
