@extends('layouts.base')

@section('styles')
    <script src="https://js.paystack.co/v1/inline.js"></script>
@endsection

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Checkout</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->

    <checkout paystack_pk="{{$paystack_pk}}" raw_user="{{$user}}"></checkout>

@endsection
