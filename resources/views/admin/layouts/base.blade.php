<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <style>

        .fa-trash{

            color: red;
            cursor: pointer;
            font-size: 20px !important;

        }

        .fa-edit{

            color: #191d21;
            cursor: pointer;
            font-size: 20px !important;

        }
        .fa-eye{

            color: yellowgreen;

        }

    </style>
    @yield('styles')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>

        @include('admin.layouts.header')

        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @yield('content')
            </section>
        </div>

        @include('admin.layouts.footer')

    </div>
</div>

<!-- General JS Scripts -->
<script src="{{asset('admin/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('admin/js/moment.min.js')}}"></script>

<script src="{{asset('admin/js/stisla.js')}}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{asset('admin/js/scripts.js')}}"></script>
<script src="{{asset('admin/js/custom.js')}}"></script>

<!-- Page Specific JS File -->
@yield('scripts')
</body>
</html>
