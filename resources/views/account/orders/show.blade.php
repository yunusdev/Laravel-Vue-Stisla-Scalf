@extends('layouts.base')

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Order View</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li><a href="#">Account</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Order #{{$order->tracking_number}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <view-user-order raw_order="{{$order}}" raw_url="{{$url}}" raw_user="{{auth()->user()}}"></view-user-order>

@endsection
