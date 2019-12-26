<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //

    public function index(){

        $users = User::all();

        return view('admin.users.index', compact('users'));

    }

    public function delete($id){

        User::findOrFail($id)->delete();

        return back()->with('message_delete', 'The User has been deleted Successfully');

    }

}
