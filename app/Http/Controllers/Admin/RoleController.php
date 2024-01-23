<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        $permissions = Permission::all();
        return response()->json([
            'status'=>true,
            'roles'=>$roles,
            'permissions'=>$permissions
        ],200);
    }

    public function store(Request $request) {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $role->givePermissionTo($request->permissions);
        return response()->json([
            'status' => true,
            'role' => $role,
        ],200);
    }

    public function update(Request $request) {
        $role = Role::where('name' , $request->name)->first();
        $permissions = $request->permissions;
        $role->syncPermissions([$permissions]);

        return response()->json([
            'status' => true,
            'role' => $role
        ],200);

    }
}
