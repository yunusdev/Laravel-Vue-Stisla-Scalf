@extends('admin.layouts.base')


@section('title')
{{$title}}
@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset('admin/datatables/dataTables.bootstrap4.css')}}">


@endsection

@section('content')

    <div class="section-header">
        <h1>{{$title}}</h1>
    </div>

    <div class="section-body" style="">

        <div class="row">

            <div class="col-12" >

                <div class="card" style="padding: 20px">

                    <products raw_products="{{$products}}"></products>

                </div>


            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{asset('admin/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/datatables/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>

@endsection
