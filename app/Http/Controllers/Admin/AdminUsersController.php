<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdminUsersController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        //
       $admins = Admin::all();

        return view('admin.admins.index', compact('admins'));
    }

    public function create(){


//        if(auth('admin')->user()->hasPermissionTo('CreateUsers')){

            $roles = Role::all();

            return view('admin.admins.create', compact('roles'));

//        }
//
//        return back();


    }

    public function store(Request $request)
    {

        $this->validate(request(),[

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',

        ]);

        $input = $request->all();

        $admin = new Admin;

        $admin->name = $request->name;

        $admin->email = $request->email;

        $admin->password = bcrypt($request->password);

        $admin->status = $request->status;

        $admin->status  = $request->status ? $request->status : 0;

        $admin->save();

        if (isset($request->roles)) $admin->syncRoles($request->roles);

        return redirect(route('admins.index'))->with('message', 'The Admin has been created successfully!');

    }

    public function edit($id)
    {
        //

//        if(auth('admin')->user()->hasPermissionTo('EditUsers')) {

            $admin = Admin::find($id);

            $roles = Role::all();

            return view('admin.admins.edit', compact('admin', 'roles'));

//        }

//        return back();
    }

    public function update(Request $request, $id)
    {
        //

        $this->validate(request(), [

            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
//            'password' => 'required|string|min:6|confirmed',

        ]);


        $request->status == 1 ?: $request['status'] = 0;

        $input = $request->all();

        $admin = Admin::findOrFail($id);

        $admin->name = $request->name;

        $admin->email = $request->email;

//        $admin->password = bcrypt($request->password);

        $admin->status = $request->status;

        $admin->save();

        if (isset($request->roles)){

            $admin->syncRoles($request->roles);

        }else {
            $admin->roles()->detach();
        }

        return redirect(route('admins.index'))->with('message_update', 'The Admin has been updated successfully!');

    }

    public function destroy($id)
    {
        //
        $admin = Admin::find($id);

        $admin->delete();

        return back()->with('message_delete', 'The Admin has been deleted successfully!');

    }

}
