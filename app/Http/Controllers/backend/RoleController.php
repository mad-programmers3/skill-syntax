<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
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
//        $permittedModules = Module::selectRaw("modules.*, CASE WHEN role_modules.module_id IS NOT NULL THEN 1 ELSE 0 END AS checked")->leftJoin('role_modules',function ($join) use ($id){
//            $join->on('role_modules.module_id','=','modules.id');
//            $join->where('role_modules.role_id', $id);
//        })->toSql();


        $data = [];
        parent::show(
            $id,
            $with,$callBackBefore,
            function ($callBackAfter) use (&$data) {
                $data['role_modules'] = collect($callBackAfter->role_modules)->pluck('id')->toArray();
                $data['role_permissions'] = collect($callBackAfter->role_modules)->pluck('id')->toArray();
            }
        );

        return response()->json(['result' => $data]);
    }
}
