@extends('layouts.base')

@section('content')
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Register</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form  method="POST" action="{{ route('register') }}" class="login-box">
                    @csrf

                    <h4 class="margin-bottom-1x text-center">Register</h4>

                    <div class="form-group input-group mb-40" style="">
                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <span class="input-group-addon"><i class="icon-head"></i></span>
                        @error('name')
                        <div class="invalid-tooltip" style="margin-bottom: 35px !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group input-group mb-40" style="">
                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="input-group-addon"><i class="icon-mail"></i></span>
                        @error('email')
                        <div class="invalid-tooltip" style="margin-bottom: 35px !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group input-group mb-40" >
                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Password" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                        @error('password')
                        <div class="invalid-tooltip">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group input-group mb-40" >
                        <input class="form-control" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Password Confirmation" required><span class="input-group-addon"><i class="icon-lock"></i></span>
                    </div>

                    <div class="text-center text-sm-right">
                        <button class="btn btn-rounded btn-primary margin-bottom-none" type="submit">Register</button>
                    </div>

                    <p class="mt-3 mb-0 text-center">Or Register With</p>
                    <div class="row margin-bottom-1x">
                        <div class="col-xl-4 col-md-6 col-sm-4"><a class="btn btn-sm btn-block facebook-btn" href="#"><i class="socicon-facebook"></i>&nbsp;Facebook login</a></div>
                        <div class="col-xl-4 col-md-6 col-sm-4"><a class="btn btn-sm btn-block twitter-btn" href="#"><i class="socicon-twitter"></i>&nbsp;Twitter login</a></div>
                        <div class="col-xl-4 col-md-6 col-sm-4"><a class="btn btn-sm btn-block google-btn" href="#"><i class="socicon-googleplus"></i>&nbsp;Google+ login</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
