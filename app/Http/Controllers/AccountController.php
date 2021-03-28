<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
use App\Models\Product;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    private $accountRepository;

    public function __construct(AccountContract $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function profile(){

        return view('account.profile');

    }

    public function updateProfile(Request $request){

        try {

            $this->validate($request, [

                'name' => 'required',
                'phone' => 'required',
                'password' => 'confirmed',

            ]);

            $params = $request->only('name', 'phone', 'password');

            return $this->accountRepository->updateProfile($params);


        }catch (\Throwable $throwable){

            throw $throwable;
        }

    }

    public function address(){

        $data['user'] = $this->accountRepository->getUserAndAddress();

        return view('account.address')->with($data);

    }

    public function updateAddress(Request $request){

        try {

            $this->validate($request, [

                'country' => 'required',
                'state' => 'required',
                'lga' => 'required',
                'address' => 'required',

            ]);

            $params = $request->only('country', 'state', 'lga', 'address');

            return $this->accountRepository->updateOrCreateUserAddress($params);

        }catch (\Throwable $throwable){

            throw $throwable;
        }

    }

    public function wishlist(){

        return view('account.wishlist');

    }

    public function userWishlist(){

        return $this->accountRepository->getUserWishlists();

    }

    public function wishlistProduct(Request $request, Product $product){


        try {

            $this->validate($request, [

                'wishlist' => 'required',

            ]);

            return $this->accountRepository->wishlistProduct($product, $request['wishlist']);

        }catch (\Throwable $throwable){

            throw $throwable;
        }


    }

    public function removeItemFromWishlist(Product $product){

        return $this->accountRepository->removeItemFromWishlist($product);

    }

    public function wishlistClear(Request $request){

        return $this->accountRepository->clearUserWishList();


    }

}
