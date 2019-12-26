<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     *
     *
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }


        return $this->sendFailedLoginResponse($request);
    }

    public function credentials(Request $request)
    {

        $admin = Admin::where('email', $request->email)->first();

        // if (count($admin)){

        if ($admin){

            if ($admin->status == 0){

                return ['email'=>'inactive', 'password'=>'Please Contact the Administrator. You are not granted permission',];


            }else{

                return ['email'=>$request->email, 'password'=>$request->password, 'status' =>1];

            }

        }else{

            return $request->only($this->username(), 'password');

        }

    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        return redirect(url('/'));

    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {

        return Auth::guard('admin');

    }
}
