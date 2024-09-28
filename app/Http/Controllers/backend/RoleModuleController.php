<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\RoleModule;
use Illuminate\Http\Request;

class RoleModuleController extends Controller
{
    public function index()
    {
        return response()->json(RoleModule::with(['role', 'module'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',    // Validate that role_id exists in roles table
            'module_id' => 'required|exists:modules,id' // Validate that module_id exists in modules table
        ]);

        $roleModule = RoleModule::create($request->all());
        return response()->json($roleModule, 201);
    }

    public function destroy($id)
    {
        $roleModule = RoleModule::findOrFail($id);
        $roleModule->delete();
        return response()->json(null, 204);
    }
}
