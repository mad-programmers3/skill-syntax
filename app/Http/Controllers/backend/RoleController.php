<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends Controller {

    // Fetch all roles
    public function index() {
        return response()->json(Role::all());
    }

    // Show specific role
    public function show($id) {
        return response()->json(Role::findOrFail($id));
    }

    // Store a new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Role created successfully', 'role' => $role], 201);
    }


    // Update an existing role
    public function update(Request $request, $id) {
        // Validate request
        $request->validate([
            'name' => 'required',
        ]);

        // Find the role by ID and update it
        $role = Role::findOrFail($id);
        $role->update($request->all());

        return response()->json($role);
    }

    // Delete a role
    public function destroy($id) {
        Role::destroy($id);
        return response()->json(null, 204);  // No content
    }
}