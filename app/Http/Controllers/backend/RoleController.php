<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleModule;
use App\Models\RolePermission;
use App\Supports\BaseCrudHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use BaseCrudHelper;

    public function __construct()
    {
        $this->model = new Role(); // Inject the Role model // Example: eager load 'permissions' and 'users' for show
    }


    public function show($id)
    {
        try {
            // Fetch the record with optional relationships
            $record = Role::with('users:id,role_id,name')->findOrFail($id);

            $record->setAttribute('modules', RoleModule::where('role_id', $id)->pluck('module_id')->toArray());
            $record->setAttribute('permissions', RolePermission::where('role_id', $id)->pluck('permission_id')->toArray());

            return $this->retRes('Successfully found record', $record, 200); // Use the standard 200 status code
        } catch (ModelNotFoundException $e) {
            return $this->retRes('Record not found', null, 404);
        } catch (\Exception $e) {
            return $this->retRes('Something went wrong with fetching the record', null, 500);
        }
    }

    public function addPermission(Request $request)
    {
        $record = null;
        try {
            if ($request->module_id) {
                $record = RoleModule::create($request->all());
            } else if ($request->permission_id) {
                $record = RolePermission::create($request->all());
            } else {
                return $this->retRes('Invalid data provided', $record, 400); // Handle invalid type error
            }

            return $this->retRes('Permission added successfully', $record); // Success response
        } catch (\Exception $e) {
            return $this->retRes('Something went wrong with adding new permission', $record, 500);
        }
    }

    public function removePermission(Request $request)
    {
        try {
            if ($request->module_id) {
                $record = RoleModule::where('role_id', $request->role_id)->where('module_id', $request->module_id)->first();
            } else if ($request->permission_id) {
                $record = RolePermission::where('role_id', $request->role_id)->where('permission_id', $request->permission_id)->first();
            } else {
                return $this->retRes('Invalid data provided', null, 400); // Handle invalid data error
            }

            // If the record is found, delete it
            if ($record) {
                return $this->retRes('Permission deleted successfully', $record->delete()); // Success response
            }

            return $this->retRes('Record not found', null, 404); // Handle record not found
        } catch (\Exception $e) {
            return $this->retRes('Something went wrong with removing the permission', null, 500); // Handle exception
        }
    }

}
