<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModulesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawPermissions = ['view', 'add', 'edit', 'delete'];

        $modulesNodes = [
            [
                'module' => ['name' => 'Dashboard', 'link' => '/admin/dashboard', 'icon' => 'far fa-clock fa-fw'],
                'permissions' => $rawPermissions,
                'nodes' => []
            ],
            [
                'module' => ['name' => 'Course', 'icon' => 'fa fa-boxes'],
                'nodes' => [
                    [
                        'module' => ['name' => 'Courses', 'link' => '/admin/course/courses', 'icon' => 'fa fa-box'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Lessons', 'link' => '/admin/course/lessons', 'icon' => 'fa fa-box'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Categories', 'link' => '/admin/course/categories', 'icon' => 'fa fa-tags'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Sub Categories', 'link' => '/admin/course/sub-categories', 'icon' => 'fa fa-tag'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                ]
            ],
            [
                'module' => ['name' => 'Review', 'icon' => 'fa fa-boxes'],
                'nodes' => [
                    [
                        'module' => ['name' => 'Reviews', 'link' => '/admin/review/reviews', 'icon' => 'fa fa-box'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Course Reviews', 'link' => '/admin/review/course-review', 'icon' => 'fa fa-box'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Lessons Reviews', 'link' => '/admin/review/lesson-review', 'icon' => 'fa fa-tags'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Testimonials', 'link' => '/admin/review/testimonials', 'icon' => 'fa fa-tag'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                ]
            ],
            [
                'module' => ['name' => 'User', 'icon' => 'fa fa-user'],
                'nodes' => [
                    [
                        'module' => ['name' => 'Profile', 'link' => '/admin/user/profile', 'icon' => 'fa fa-id-card'],
                        'permissions' => ['show', 'edit', 'delete'],
                        'nodes' => []
                    ],
                    [
                        'module' => ['name' => 'Users', 'link' => '/admin/user/users', 'icon' => 'fa fa-users'],
                        'permissions' => $rawPermissions,
                        'nodes' => []
                    ],
                ]
            ],
            [
                'module' => ['name' => 'Table', 'link' => '/admin/table-basic', 'icon' => 'fa fa-table'],
                'nodes' => []
            ],
            [
                'module' => ['name' => 'Root Module 4', 'link' => '/api/module4', 'icon' => 'fa fa-chart-line'],
                'nodes' => []
            ]
        ];

        $this->insertModules($modulesNodes);
    }

    /**
     * Recursively insert modules into the database using Eloquent models.
     *
     * @param array $nodes
     * @param int $parentId
     * @return void
     */
    protected function insertModules(array $nodes, $parentId = 0)
    {
        foreach ($nodes as $n) {
            $moduleData = $n['module'];
            $permissions = $n['permissions'] ?? null;
            $moduleData['parent_id'] = $parentId;

            $module = Module::create($moduleData);
            $moduleId = $module->id;

            if ($permissions) {
                foreach ($permissions as $permission) {
                    Permission::create([
                        'module_id' => $module->id,
                        'name' => $this->formattedModuleName($module->name) . '_' . $permission,
                    ]);
                }
            }

            // Insert child modules
            $this->insertModules($n['nodes'], $moduleId);
        }
    }



    private function formattedModuleName($name)
    {
        /************************************************************************************
         * Convert to lowercase, replace spaces with underscores, and convert to singular:  *
         *      Products => product                                                         *
         *      Sub Categories => sub_category                                              *
         * **********************************************************************************/
        $lowercase = strtolower($name);
        $noSpaces = str_replace(' ', '_', $lowercase);
        return Str::singular($noSpaces);
    }
}