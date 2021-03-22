<?php

namespace App\Http\Controllers;

use App\Contracts\AccountContract;
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
}
