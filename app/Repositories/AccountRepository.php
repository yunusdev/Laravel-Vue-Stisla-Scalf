<?php

namespace App\Repositories;

use App\Contracts\AccountContract;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Boolean;

class AccountRepository implements AccountContract
{
    //
    public function updateProfile(array $params)
    {

        if ($params['password']){
            $params['password'] = bcrypt($params['password']);
        }else{
            unset($params['password']);
        }

        return User::where('id', auth()->id())->update($params);

    }

    public function getUserAndAddress(string $userId = null)
    {
        if (!$userId) $userId = auth()->id();
        Log::debug($userId);
        $user = User::where('id', $userId)->first();
        if ($user) $user['address'] = UserAddress::where('user_id', $userId)->first();
        return  $user;

    }

    public function getUserWishlists(string $userId = null)
    {

        if (!$userId){

            return auth()->user()->wishlists;

        }

        return [];
    }

    public function wishlistProduct(Product $product, $wishlist)
    {

        if ($wishlist){

            $product->wishlists()->attach(auth()->id());
            return ['message' => 'Product added to wishlist'];

        }


        $product->wishlists()->detach(auth()->id());
        return ['message' => 'Product removed from wishlist'];


    }

    public function removeItemFromWishlist(Product $product, $user = null)
    {
        if (!$user) $user = auth()->user();

        $user->wishlists()->detach($product->id);

        return ['message' => 'Product removed from wishlist'];

    }

    public function clearUserWishList($user = null)
    {
        if (!$user) $user = auth()->user();

        $user->wishlists()->detach();

        return ['message' => 'Wishlist cleared'];

    }


    public function updateOrCreateUserAddress(array $params, string $userId = null)
    {

        if (!$userId) $userId = auth()->id();
        return UserAddress::updateOrCreate(['user_id' => $userId], $params);

    }

    public function createOrUpdateUserPhone(array $params, string $userId = null)
    {
        $user = auth()->user();
        $user['phone'] = $params['phone'];
        $user->save();
    }


}
