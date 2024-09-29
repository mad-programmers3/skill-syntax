<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        // Fetch roles and permissions along with their associations
        $roles = Role::with('permissions')->get(); // Ensure roles exist
        $permissions = Permission::all(); // Ensure permissions exist

        return response()->json(['roles' => $roles, 'permissions' => $permissions]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        // Attach the permission to the role
        $role = Role::find($request->role_id);
        $role->permissions()->attach($request->permission_id);

        return response()->json(['message' => 'Permission added to role successfully'], 201);
    }

    public function destroy($roleId, $permissionId)
    {
        \Log::info("Removing permission $permissionId from role $roleId");

        $role = Role::findOrFail($roleId);
        $role->permissions()->detach($permissionId);

        return response()->json(null, 204);
    }


}
