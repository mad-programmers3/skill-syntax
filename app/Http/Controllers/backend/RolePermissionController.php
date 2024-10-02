<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends DatabaseCrudController
{


    public function __construct()
    {
        parent::__construct(new RolePermission());

    }

//    public function index()
//    {
//        // Fetch roles and permissions along with their associations
//        $roles = Role::with('permissions')->get(); // Ensure roles exist
//        $permissions = Permission::all(); // Ensure permissions exist
//
//        return response()->json(['roles' => $roles, 'permissions' => $permissions]);
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'role_id' => 'required|exists:roles,id',
//            'name' => 'required|string|unique:roles,name',  // This will ensure unique name validation
//        ]);
//
//
//        // Find the role by the ID
//        $role = Role::find($request->role_id);
//
//        // Find the permission based on module_id and action
//        $permission = Permission::where('module_id', $request->module_id)
//            ->where('action', $request->action)
//            ->first();
//
//        if (!$permission) {
//            return response()->json(['message' => 'Permission not found'], 404);
//        }
//
//        // Check if the permission is already attached to the role
//        if ($role->permissions()->where('id', $permission->id)->exists()) {
//            return response()->json(['message' => 'Permission already exists for this role'], 409);
//        }
//
//        // Attach the permission to the role
//        $role->permissions()->attach($permission->id);
//
//        return response()->json(['message' => 'Permission added successfully'], 201);
//    }
//
//
//    public function destroy($roleId, $moduleId, $action)
//    {
//        \Log::info("Removing permission for role $roleId, module $moduleId, action $action");
//
//        $role = Role::findOrFail($roleId);
//
//        $permission = Permission::where('module_id', $moduleId)
//            ->where('action', $action)
//            ->first();
//
//        if (!$permission) {
//            return response()->json(['message' => 'Permission not found'], 404);
//        }
//
//        $role->permissions()->detach($permission->id);
//
//        return response()->json(['message' => 'Permission removed successfully'], 204);
//    }



}
