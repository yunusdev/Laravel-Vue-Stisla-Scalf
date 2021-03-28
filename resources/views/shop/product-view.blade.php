@extends('layouts.base')

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Single Product</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li><a href="{{url('/shop')}}">Shop</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Single Product</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <product-view current_url="{{url()->current()}}" raw_related_products="{{$related_products}}" raw_product="{{$product}}"></product-view>

@endsection
