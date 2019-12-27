@extends('admin.layouts.base')

@section('title')
    Create Admin
@endsection

@section('content')

<div class="section-header">
    <h1>Create Admin</h1>
</div>

<div class="section-body" style="">

    <div class="row">
        <div class="col-12">

            <div class="card ">
                <!-- /.card-header -->
                <div class="col-lg-6 ">
                    @include('includes.form_error')
                </div>
                <!-- form start -->
                <form role="form" method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="card-body">

                        <div class="col-lg-5">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" value="{{old('email')}}"  class="form-control" id="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control" value="{{old('phone')}}"  name="phone" id="phone" placeholder="Enter  number ">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Profile Pic</label>

                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="picture" type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="control-label">Status</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="status" id="status" @if(old('status') == 1)checked @endif  value="1" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Status</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Attach Role(s)</label>
                                <div class="selectgroup selectgroup-pills" >
                                    @forelse($roles as $role)
                                        <label class="selectgroup-item" >
                                            <input type="checkbox" name="roles[]"  value="{{$role->id}}" class="selectgroup-input">
                                            <span class="selectgroup-button">{{$role->name}}</span>
                                        </label>

                                        @empty

                                        <p><em>No roles... Add <a href="{{route('role.index')}}">here<i class="fas  fa-plus-circle"></i></a></em> </p>

                                    @endforelse

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{route('admins.index')}}" class="btn btn-danger">Back</a>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

@endsection