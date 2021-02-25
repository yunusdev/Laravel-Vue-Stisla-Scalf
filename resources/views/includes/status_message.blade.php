@if(session()->has('message'))

    {{--    <p class="alert alert-success" style="margin-top: 20px;">{{session('message')}}</p>--}}
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{session('message')}}
    </div>
@endif
@if(session()->has('message_delete'))

    {{--    <p class="alert alert-success" style="margin-top: 20px;">{{session('message')}}</p>--}}
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{session('message_delete')}}
    </div>
@endif
@if(session()->has('message_update'))

    {{--    <p class="alert alert-success" style="margin-top: 20px;">{{session('message')}}</p>--}}
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{session('message_update')}}
    </div>
@endif