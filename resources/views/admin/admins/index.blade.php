@extends('admin.layouts.base')


@section('styles')

    <link rel="stylesheet" href="{{asset('admin/datatables/dataTables.bootstrap4.css')}}">

@endsection

@section('content')

    <div class="section-header">
        <h1>Admins</h1>
    </div>

    <div class="section-body" style="">

        <div class="row">
            <div class="col-12">

                <div class="card" style="padding: 20px">

                    <div>
                        <div class="box-header"  >
                            @include('includes.form_error')
                            <br>
                        </div>
                        <div class="float-right mb-4">
                            <a style="padding: 10px" href="{{route('admins.create')}}" class=" pull-right btn btn-primary">
                                <i class="fas fa-user-plus" style="padding-right: 10px"></i>Add New Admin
                            </a>
                        </div>
                        <br>

                        <!-- /.card-header -->
                        <div class="box-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Admin Name</th>
                                    <th>Status</th>
                                    <th>Assigned Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>

                                @if($admins)
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{$admin->id}}</td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->status == 1 ? 'Active': 'Not Active' }}</td>
                                            <td> {{$admin->roles()->pluck('name')->implode(' | ')}}</td>

                                            <td><a href="{{route('admins.edit', $admin->id)}}"><span class="fas fa-edit"></span></a></td>
                                            <td>

                                                <form method="post" id="delete-form-{{$admin->id}}" action="{{route('admins.destroy', $admin->id)}}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}

                                                </form>

                                                <a href="" onclick="
                                                    if(confirm('Are you sure you want to delete this ?'))
                                                    {
                                                    event.preventDefault();document.getElementById('delete-form-{{$admin->id}}').submit();}
                                                    else
                                                    {event.preventDefault();}">
                                                    <span class="text-center fas fa-trash" ></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Admin Name</th>
                                    <th>Status</th>
                                    <th>Assigned Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
