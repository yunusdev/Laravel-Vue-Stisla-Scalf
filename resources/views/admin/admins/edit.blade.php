@extends('admin.layouts.base')

@section('title')
    >Edit Admin - {{$admin->name}}
@endsection

@section('content')

<div class="section-header">
    <h1>Edit Admin - <b><i>{{$admin->name}}</i></b></h1>
</div>

<div class="section-body" style="">


    <div class="row">
            <div class="col-12">

                <div class="card ">
                    <div class="col-lg-6 ">
                        @include('includes.form_error')
                    </div>
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admins.update', $admin->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        <div class="card-body">

                            <div class="col-lg-5">

                                <div class="form-group ">
                                    <label for="name"> Name</label>
                                    <input type="text" value="@if(old('name')) {{old('name')}} @else {{$admin->name}} @endif" class="form-control" name="name" id="name" placeholder="Enter  username">
                                </div>
                                <div class="form-group ">
                                    <label for="email"> Email</label>
                                    <input type="email" value="@if(old('email')) {{old('email')}} @else {{$admin->email}} @endif" class="form-control" name="email" id="email" placeholder="Enter  email ">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" value="{{$admin->phone}}"  class="form-control" name="phone" id="phone" placeholder="Enter  number ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Profile Pic</label>
                                    <img class="pull-right p-2"  height="50" width="50" src="/AdminProfilePic/{{$admin->photo ? $admin->photo->path : "No photo"}}" alt="">

                                    <div class="input-group">
                                        <div class="custom-file">

                                            <input name="photo_id" type="file" class="custom-file-input" id="exampleInputFile">
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
                                        <input type="checkbox" name="status" id="status" @if(old('status') == 1 || $admin->status == 1)checked @endif value="1" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Status</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Attach Role(s)</label>
                                    <div class="selectgroup selectgroup-pills" >
                                        @foreach($roles as $role)
                                            <label class="selectgroup-item" >
                                                <input type="checkbox" name="roles[]"  value="{{$role->id}}" class="selectgroup-input"
                                               @foreach($admin->roles as $adrole)
                                                    @if($adrole->id  == $role->id)
                                                         checked
                                                    @endif
                                                @endforeach

                                                >
                                                <span class="selectgroup-button">{{$role->name}}</span>
                                            </label>
                                        @endforeach

                                    </div>
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

