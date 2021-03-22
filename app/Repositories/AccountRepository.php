<?php

namespace App\Repositories;

use App\Contracts\AccountContract;
use App\Models\User;

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


}
