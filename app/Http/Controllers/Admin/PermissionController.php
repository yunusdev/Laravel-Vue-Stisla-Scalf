<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
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

    public function store(Request $request)
    {
        try {

            $this->validate($request, [

                'name' => 'required|max:50|unique:permissions',

            ]);

            $input = $request->all();

            return Permission::create($input);

        }catch (\Throwable $exception){

            throw $exception;

        }


    }


    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);

        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        try {

            $this->validate($request, [

                'name' => 'required|max:50',

            ]);

            $input = $request->all();

            $permission = Permission::findOrFail($id);

            $permission->update($input);

            return $permission->fresh();

        }catch (\Throwable $exception){

            throw $exception;
        }


    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return response()->json('ok');

    }
}
