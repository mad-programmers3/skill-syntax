<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleModule;
use App\Models\RolePermission;
use App\Supports\BaseCrudHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

}
