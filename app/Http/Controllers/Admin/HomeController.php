<?php

namespace App\Http\Controllers\Admin;


use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::get()->take(4);

        return view('admin.home', compact('admins'));

    }
}
