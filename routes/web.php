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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/roles', 'AclController@roles');

Route::get('/roles/create_roles', 'AclController@create_roles');

Route::get('/roles/edit_roles/{id_role}', 'AclController@edit_roles');

Route::post('/roles/store_roles', 'AclController@store_roles');

Route::get('/permissions', 'AclController@permissions');

Route::get('/permissions/create_permissions', 'AclController@create_permissions');

Route::post('/permissions/store_permissions', 'AclController@store_permissions');
