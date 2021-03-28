<?php

namespace App\Contracts;

use App\Models\Product;

interface AccountContract
{

    public function updateProfile(array $params);

    public function getUserAndAddress(string $userId = null);

    public function getUserWishlists(string $userId = null);

    public function wishlistProduct(Product $product, $wishlist);

    public function removeItemFromWishlist(Product $product, $user = null);

    public function clearUserWishList($user = null);

    public function updateOrCreateUserAddress(array $params, string $userId = null);

    public function createOrUpdateUserPhone(array $params, string $userId = null);

}
