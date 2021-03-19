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

Auth::routes();

Route::get('/',
    [App\Http\Controllers\HomeController::class, 'index']
)->name('home');

Route::get('/shop',
    [App\Http\Controllers\ShopController::class, 'index']
)->name('shop');

Route::get('/category/{slug}/products',
    [App\Http\Controllers\CategoriesController::class, 'categoryProducts']
)->name('category.products');

Route::get('/sub-category/{slug}/products',
    [App\Http\Controllers\CategoriesController::class, 'subCategoryProducts']
)->name('sub-category.products');

Route::get('/product/{slug}',
    [App\Http\Controllers\ShopController::class, 'viewProduct']
)->name('view.product');

Route::get('cart',
    [App\Http\Controllers\CartController::class, 'index']
)->name('product.cart');

Route::get('cart/user',
    [App\Http\Controllers\CartController::class, 'getUserCartItems']
);

Route::post('cart/add/item',
    [App\Http\Controllers\CartController::class, 'addItemsToCart']
)->name('product.cart');

Route::delete('/cart/clear',
    [App\Http\Controllers\CartController::class, 'clearCart']
);

Route::delete('cart/remove/item/{item}',
    [App\Http\Controllers\CartController::class, 'removeItem']
);

Route::group(['middleware'=>'auth'], function() {

    Route::get(
        '/logout',
        [\App\Http\Controllers\Auth\LoginController::class, 'logout']
    );

});

Route::group(['prefix'=>'admin'], function() {

    Route::get(
        '/login',
            [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm']
    )->name('admin.login');

    Route::post(
        '/login',
        [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login']
    );

    Route::group(['middleware'=>'auth:admin'], function() {

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
            '/permission',
            \App\Http\Controllers\Admin\PermissionController::class,
        );

        Route::resource(
            '/role',
            \App\Http\Controllers\Admin\RoleController::class,
        );

        Route::resource(
            '/categories',
            \App\Http\Controllers\Admin\CategoriesController::class,
        );

        Route::get(
            '/categories/{category}/products',
            [\App\Http\Controllers\Admin\CategoriesController::class, 'getProducts']
        )->name('categories.products');

        Route::get(
            '/sub-categories',
            [\App\Http\Controllers\Admin\SubCategoriesController::class, 'getAll']
        )->name('sub-categories.getAll');

        Route::get(
            '/sub-categories/{subCategory}/products',
            [\App\Http\Controllers\Admin\SubCategoriesController::class, 'getProducts']
        )->name('sub-categories.products');

        Route::resource(
            '/{category}/sub-categories',
            \App\Http\Controllers\Admin\SubCategoriesController::class,
        );

        Route::resource(
            '/products',
            \App\Http\Controllers\Admin\ProductsController::class,
        );

        Route::resource(
            '/coupons',
            \App\Http\Controllers\Admin\CouponsController::class,
        );

    });
});
