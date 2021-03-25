@extends('layouts.base')

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Wishlist</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li><a href="#">Account</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <user-wishlists raw_url="{{$url}}" raw_user="{{auth()->user()}}"></user-wishlists>

@endsection
