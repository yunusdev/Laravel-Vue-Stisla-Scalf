<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\User\Photo;
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
        //

//        return $request;

        $this->validate(request(),[

            'phone' => 'required|numeric',
            'name' => 'required|string|max:255',
            'picture' => 'required',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',

        ]);

        $input = $request->all();

        if ($file = $request->file('picture')){

            $name = time() . $file->getClientOriginalName();

            $file->move('AdminProfilePic', $name);

            $photo = Photo::create(['path'=>$name]);

        }

        $admin = new Admin;

        $admin->name = $request->name;

        $admin->phone = $request->phone;

        $admin->email = $request->email;

        $admin->password = bcrypt($request->password);

        $admin->status = $request->status;

        $admin->status  = $request->status ? $request->status : 0;

        $admin->photo_id = $photo->id;


        $admin->save();

        if (isset($request->roles)){

            $admin->syncRoles($request->roles);

        }

        return redirect(route('admins.index'))->with('message', 'The Admin has been created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate(request(), [

            'phone' => 'required|numeric',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
//            'photo_id' => 'required',

//            'password' => 'required|string|min:6|confirmed',

        ]);


        $request->status == 1 ?: $request['status'] = 0;

//        $admin = Admin::find($id)->update($request->except('_token', '_method','role'));
//
        $input = $request->all();

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('AdminProfilePic', $name);

            $photo = Photo::create(['path' => $name]);

        }

        $admin = Admin::findOrFail($id);

        if ($file = $request->file('photo_id')) {

            $admin->photo_id = $photo->id;

        }

        $admin->name = $request->name;

        $admin->phone = $request->phone;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Admin::find($id);

        unlink(public_path('/AdminProfilePic/') . $admin->photo->path);

        $admin->delete();

        return back()->with('message_delete', 'The Admin has been deleted successfully!');

    }

}
