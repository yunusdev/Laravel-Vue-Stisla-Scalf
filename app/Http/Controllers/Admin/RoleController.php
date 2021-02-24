<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\assertGreaterThanOrEqual;

class RoleController extends Controller
{
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

    public function store(Request $request)
    {
        //
        try {
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
        }catch (\Throwable $exception){

            throw $exception;
        }

    }

    public function update(Request $request, $id)
    {

        try {

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

        }catch (\Throwable $exception){

            throw $exception;
        }

    }

    public function destroy($id)
    {
        //
        Role::findOrFail($id)->delete();

        return response()->json('ok');

    }
}
