<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        $permissions = Permission::all();

        return view('admin.permission.index', compact('permissions'));
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

        $this->validate($request, [

            'name' => 'required|max:50|unique:permissions',



        ]);

        $input = $request->all();

        return Permission::create($input);

    }


    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);

        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [

            'name' => 'required|max:50',

        ]);

        $input = $request->all();

        $permission = Permission::findOrFail($id);

        $permission->update($input);

        return $permission->fresh();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Permission::findOrFail($id)->delete();

        return response()->json('ok');

    }
}
