<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin'], function() {

    Route::get(
        '/login',
            [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm']
    )->name('admin.login');

    Route::post(
        '/login',
        [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login']
    );

    Route::get(
        '/logout',
        [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout']
    )->name('admin.logout');

    Route::get(
        '/users',
        [\App\Http\Controllers\Admin\UsersController::class, 'index']
    )->name('users.index');

    Route::delete(
        '/users/delete/{id}',
        [\App\Http\Controllers\Admin\UsersController::class, 'delete']
    )->name('users.destroy');

    Route::get(
        '/home',
        [\App\Http\Controllers\Admin\HomeController::class, 'index']
    )->name('admin.home');

    Route::resource(
        '/admins',
        \App\Http\Controllers\Admin\AdminUsersController::class,
    );

    Route::resource(
        '/role',
        \App\Http\Controllers\Admin\RoleController::class,
    );

    Route::resource(
        '/permission',
        \App\Http\Controllers\Admin\PermissionController::class,
    );

});
