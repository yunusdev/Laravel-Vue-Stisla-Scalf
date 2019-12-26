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


Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function() {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\LoginController@login');

    Route::get('/logout',  'Auth\LoginController@logout');

    Route::get('/users', 'UsersController@index')->name('users.index');

    Route::delete('/users/delete/{id}', 'UsersController@delete')->name('users.destroy');

    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::resource('/admins', 'AdminUsersController');

    Route::resource('/role', 'RoleController');

    Route::resource('/permission', 'PermissionController');

});
