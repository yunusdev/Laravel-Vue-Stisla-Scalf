@extends('admin.layouts.base')


@section('title')
    Create Product
@endsection

@section('styles')

@endsection

@section('content')

    <div class="section-header">
        <div class="section-header-back">
            <a href="{{route('products.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create Product</h1>
    </div>

    <div class="section-body" style="">

        <div class="row">

            <div class="col-12" >

                <div class="card" style="padding: 20px">

                    <store-product raw_categories = "{{$categories}}"></store-product>

                </div>


            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/mdb.js') }}"></script>

@endsection
