<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->giveRolePermissions('Super Admin');
        $this->giveRolePermissions('Admin', ['course_add', 'course_view', 'course_edit', 'course_delete', 'category_add', 'category_view', 'category_edit', 'category_delete']);
        $this->giveRolePermissions('Instructor', ['course_add', 'course_view', 'course_edit', 'course_delete']);
    }

    private function giveRolePermissions($roleName, array $permissions = ['all'])
    {
        $role = Role::where('name', $roleName)->first();
        if (!$role) return;

        $permissionIDs = [];

        if (count($permissions) === 1 && $permissions[0] === 'all') {
            $permissionIDs = Permission::pluck('id')->toArray();
        } else {
            // Get specific permission IDs
            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission) $permissionIDs[] = $permission->id;
            }
        }

        // Insert role-permission records
        foreach ($permissionIDs as $permID) {
            RolePermission::create([
                'role_id' => $role->id,
                'permission_id' => $permID,
            ]);
        }
    }
}