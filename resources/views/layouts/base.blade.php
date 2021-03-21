<!DOCTYPE html>
<html lang="en">
<head>
{{--    acb5f6--}}
    <meta charset="utf-8">
    <title>MY WEARS
    </title>
    <!-- SEO Meta Tags-->
    <meta name="description" content="MY WEARS - Universal E-Commerce Template">
    <meta name="keywords" content="shop, e-commerce, modern, flat style, responsive, online store, business, mobile, blog, bootstrap 4, html5, css3, jquery, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Rokaux">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{asset('css/vendor.min.css')}}">
    <link rel="stylesheet" media="screen" href="{{asset('css/base.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('css/styles.min.css')}}">
    <!-- Modernizr-->
    <script src="{{asset('js/modernizr.min.js')}}"></script>
    @yield('styles')
</head>
<!-- Body-->
<body>

    <div id="app">

        {{--@include('layouts.header')--}}
        <nav-bar raw_user="{{auth()->user()}}"></nav-bar>

        <div class="offcanvas-wrapper">
            <!-- Page Content-->
            @yield('content')

            @include('layouts.footer')
        </div>

    </div>
<!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>
<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="{{asset('js/app.js')}}"></script>

    <script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/scripts.min.js')}}"></script>

</body>
</html>
