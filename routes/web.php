<?php

use Illuminate\Support\Facades\Route;

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

