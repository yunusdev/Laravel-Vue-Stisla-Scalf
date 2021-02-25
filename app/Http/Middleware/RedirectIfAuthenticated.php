<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {


            if (Auth::guard($guard)->check()){

                switch ($guard) {

                    case 'admin';

                        return redirect('/admin/home');

                    default;

                        return redirect('/');

                }

            }

        }

        return $next($request);
    }

//    public function handle($request, Closure $next, $guard = null)
//    {
//        \Log::debug($guard);
//
//        switch ($guard){
//
//            case 'admin';
//
//                if (Auth::guard($guard)->check()){
//
//                    return redirect('/admin/home');
//
//                }
//                break;
//
//            default;
//
//                if (Auth::guard($guard)->check()) {
//                    return redirect('/');
//                }
//
//                break;
//        }
//
//
//
//        return $next($request);
//
//    }

}
