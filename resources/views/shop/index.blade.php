@extends('layouts.base')

@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Shop</h1>
            </div>
            <div class="column">


                <ul class="breadcrumbs">
                    <li><a href="{{url('/')}}">Home</a>
                    </li>
                @if(isset($category))
                        <li class="separator">&nbsp;</li>
                        <li><a href="{{url('/shop')}}">Shop</a></li>
                        <li class="separator">&nbsp;</li>
                        <li>{{$category->name}}</li>
                @elseif(isset($sub_category))
                    <li class="separator">&nbsp;</li>
                    <li><a href="{{url('/shop')}}">Shop</a></li>
                    <li  class="separator">&nbsp;</li>
                    <li ><a href="{{route('category.products', $sub_category->category->slug)}}">
                            {{$sub_category->category->name}}</a></li>
                    <li class="separator">&nbsp;</li>
                    <li>{{$sub_category->name}}</li>
                @else
                    <li class="separator">&nbsp;</li>
                    <li>Shop</li>
                @endif

                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <shop raw_products="{{$products}}" raw_category="{{$category ?? ''}}" raw_sub_category="{{$sub_category ?? ''}}"
          raw_categories = "{{$categories}}">

@endsection
