@extends('admin.layouts.base')


@section('title')
    Permissions
@endsection

@section('styles')

    <link rel="stylesheet" href="{{asset('admin/datatables/dataTables.bootstrap4.css')}}">


@endsection

@section('content')

    <div class="section-header">
        <h1>Permissions</h1>
        {{--<button style="padding: 0px;border-radius: 30px" class="col-sm-6 col-xs-12 pull-right btn-success">--}}
            {{--<i class="fas fa-user-plus" style="padding-right: 0px"></i>Add New Merchant--}}
        {{--</button>--}}
    </div>

    <div class="section-body" style="">

        <div class="row">

            <div class="col-12" >

                <div class="card" style="padding: 20px">

                    <permissions raw_permissions = "{{$permissions}}"></permissions>

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
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

@endsection