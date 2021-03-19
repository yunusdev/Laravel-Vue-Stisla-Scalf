@extends('layouts.base')

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Cart</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <cart raw_trending_products = "{{$trending_products}}"></cart>

@endsection
