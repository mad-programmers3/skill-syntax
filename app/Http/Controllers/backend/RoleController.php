<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;


class RoleController extends DatabaseCrudController
{


    public function __construct()
    {
        parent::__construct(new Role());

    }

    public function index($with = ['users:id,role_id,name,email'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::index($with, $callBackBefore, $callBackAfter);
    }

    public function show($id, $with = ['users:id,role_id,name,email'], $callBackBefore = false, $callBackAfter = false)
    {
        return parent::show(
            $id,
            $with,
            $callBackBefore ? $callBackBefore : function ($query) {
                $query->with('role_modules', function ($role_module) {
                    $role_module->with('module:id,name');
                })->with('role_permissions', function ($role_permission) {
                    $role_permission->with('permission:id,module_id,name');
                });
            },
            $callBackAfter
        );
    }
}