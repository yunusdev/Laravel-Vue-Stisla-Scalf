<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin']);


    }

    public function index()
    {
        //
        $roles = Role::with('permissions')->get();

        $permissions = Permission::all();

        return view('admin.role.index', compact('roles', 'permissions'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(request(), [

            'name' => 'required|unique:roles',
            'permissions' => 'required'

        ]);

        $role = new Role;

        $role->name = $request['name'];

        $role->save();

        if (isset($request['permissions'])) {

            $role->syncPermissions($request['permissions']);

        }

        return $role;

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

            'name' => 'required',

        ]);

        $role =  Role::findOrFail($id);

        $role->name = $request['name'];

        $role->save();

        if (isset($request['permissions'])) {

            $role->syncPermissions($request['permissions']);

        }else{

            $role->permissions()->detach();
        }

        return Role::with('permissions')->where('id', $id)->first();

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
        Role::findOrFail($id)->delete();

        return response()->json('ok');

    }
}
