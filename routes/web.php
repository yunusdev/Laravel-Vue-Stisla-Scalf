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

Route::group(['prefix' => 'shop'], function (){

    Route::get('/',
        [App\Http\Controllers\ShopController::class, 'index']
    )->name('shop');

     Route::get('/categories',
         [App\Http\Controllers\ShopController::class, 'getCategories']
     );

    Route::get('/trending/products',
        [App\Http\Controllers\ShopController::class, 'trendingProducts']
    );

    Route::get('/top/sellers/{num?}',
        [App\Http\Controllers\ShopController::class, 'topSellingProducts']
    );

    Route::get('/new/arrivals',
        [App\Http\Controllers\ShopController::class, 'newArrivalsProducts']
    );

});


Route::get('/category/{slug}/products',
    [App\Http\Controllers\CategoriesController::class, 'categoryProducts']
)->name('category.products');

Route::get('/sub-category/{slug}/products',
    [App\Http\Controllers\CategoriesController::class, 'subCategoryProducts']
)->name('sub-category.products');

Route::get('/product/{slug}',
    [App\Http\Controllers\ShopController::class, 'viewProduct']
)->name('view.product');

Route::group(['prefix' => 'cart'], function (){

    Route::get('/',
        [App\Http\Controllers\CartController::class, 'index']
    )->name('product.cart');

    Route::get('/items',
        [App\Http\Controllers\CartController::class, 'getUserCartItems']
    );

    Route::post('/add/item',
        [App\Http\Controllers\CartController::class, 'addItemsToCart']
    );

    Route::delete('/remove/item/{item}',
        [App\Http\Controllers\CartController::class, 'removeItem']
    );

    Route::delete('/clear',
        [App\Http\Controllers\CartController::class, 'clearCart']
    );

});

Route::get('/checkout',
    [App\Http\Controllers\CheckoutController::class, 'index']
);

Route::post('/orders/create',
    [App\Http\Controllers\OrderController::class, 'create']
);

Route::group(['prefix' => 'locality'], function (){

    Route::get('/countries',
        [App\Http\Controllers\LocalityController::class, 'getCountries']
    );

    Route::get('/nigerian/states',
        [App\Http\Controllers\LocalityController::class, 'getNigeriaStates']
    );

    Route::get('/nigerian/states/{stateId}/lga',
        [App\Http\Controllers\LocalityController::class, 'getNigeriaStatesLGA']
    );

});


Route::group(['middleware'=>'auth'], function() {

    Route::get(
        '/logout',
        [\App\Http\Controllers\Auth\LoginController::class, 'logout']
    );

    Route::post('/coupon/validate',
        [App\Http\Controllers\CouponController::class, 'validateCoupon']
    );

    Route::group(['prefix' => 'account'], function (){

        Route::get('/user/orders',
            [App\Http\Controllers\OrderController::class, 'getUserOrders']
        );

        Route::get('/orders',
            [App\Http\Controllers\OrderController::class, 'index']
        );

        Route::get('/orders/{tracking_number}',
            [App\Http\Controllers\OrderController::class, 'show']
        );

        Route::get('/profile',
            [App\Http\Controllers\AccountController::class, 'profile']
        );

         Route::put('/profile',
             [App\Http\Controllers\AccountController::class, 'updateProfile']
         );

        Route::get('/address',
            [App\Http\Controllers\AccountController::class, 'address']
        );

        Route::put('/address',
            [App\Http\Controllers\AccountController::class, 'updateAddress']
        );

        Route::get('/wishlist',
            [App\Http\Controllers\AccountController::class, 'wishlist']
        );

        Route::get('/user/wishlist',
            [App\Http\Controllers\AccountController::class, 'userWishlist']
        );

        Route::put('/wishlist/product/{product}',
            [App\Http\Controllers\AccountController::class, 'wishlistProduct']
        );

        Route::delete('/wishlist/product/{product}/remove',
            [App\Http\Controllers\AccountController::class, 'removeItemFromWishlist']
        );

        Route::delete('/wishlist/clear',
            [App\Http\Controllers\AccountController::class, 'wishlistClear']
        );

    });

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
