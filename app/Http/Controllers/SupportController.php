<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\MyFile;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use App\Supports\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    use Helper;

    public function requiredData()
    {
        $data = [];

        if (request()->has('users'))
            $data['users'] = User::all();

        if (request()->has('courses'))
            $data['courses'] = Course::all();

        if (request()->has('categories'))
            $data['categories'] = Category::all();

        if (request()->has('sub_categories'))
            $data['sub_categories'] = SubCategory::all();

        if (request()->has('lessons'))
            $data['lessons'] = Lesson::all();

        if (request()->has('my_files'))
            $data['my_files'] = MyFile::all();

        if (request()->has('modules')) {
            // Check if relationships (like 'permissions' and 'roles') are requested
            $withRelations = [];
            if (request()->has('with_permissions')) {
                $withRelations[] = 'permissions:id,module_id,name,status';
            }
            if (request()->has('with_roles')) {
                $withRelations[] = 'roles';
            }

            // Fetch modules with or without relationships
            if (!empty($withRelations)) {
                $data['modules'] = Module::with($withRelations)->get();
            } else {
                $data['modules'] = Module::all();
            }
        }

        if (request()->has('roles'))
            $data['roles'] = Role::all();

        return retRes('Successfully fetched all records', $data);
    }



    public function getConfigurations()
    {
        $permittedModuleId = [];
        if (auth()->user() && auth()->user()->role_id)
            $permittedModuleId = DB::table('role_modules')->where('role_id', auth()->user()->role_id)->get()->pluck('module_id')->toArray();

        $data['modules'] = Module::where('parent_id', 0)
            ->whereIn('id', $permittedModuleId)
            ->with(['sub_modules'=>function ($subModules) use ($permittedModuleId) {
                $subModules->whereIn('id', $permittedModuleId);
                $subModules->with('sub_modules');
            }])
            ->get()->toArray();

        $data['permissions'] = $this->authPermissions();

        return retRes('Successfully fetched all records', $data);
    }
}