<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings =[
            // General Settings
            [
                'key' => 'application_name',
                'name' => 'Application Name',
                'type' => 'text',
                'group' => 'general',
                'value' => 'SkillSyntax'
            ],
            [
                'key' => 'default_course_status',
                'name' => 'Default course Status',
                'type' => 'select',
                'group' => 'general',
                'value' => '2'
            ],
            [
                'key' => 'default_user_role',
                'name' => 'Default User Role',
                'type' => 'select',
                'group' => 'general',
                'value' => 'Student'
            ],
            [
                'key' => 'default_document_type',
                'name' => 'Default Document Type',
                'type' => 'select',
                'group' => 'general',
                'value' => 'Employee Attachment'
            ],
            [
                'key' => 'default_course_duration',
                'name' => 'Default Course Duration (Weeks)',
                'type' => 'number',
                'group' => 'general',
                'value' => '26'
            ],
            [
                'key' => 'default_quiz_time_limit',
                'name' => 'Default Quiz Time Limit (Second)',
                'type' => 'number',
                'group' => 'general',
                'value' => '300'
            ],
            [
                'key' => 'application_logo',
                'name' => 'Application Logo',
                'type' => 'file',
                'group' => 'general',
                'value' => 'logo.png'
            ],
            [
                'key' => 'shortlist_sms',
                'name' => 'Shortlist SMS',
                'type' => 'textarea',
                'group' => 'general',
                'value' => 'Thank you for your Application, You are shortlisted for the position.'
            ],
            [
                'key' => 'selected_sms',
                'name' => 'Selected SMS',
                'type' => 'textarea',
                'group' => 'general',
                'value' => 'Congratulations, You are Selected for the position.'
            ],
            [
                'key' => 'staff_transfer_service_length',
                'name' => 'Staff Transfer Service Length',
                'type' => 'number',
                'group' => 'general',
                'value' => '3'
            ],
            [
                'key' => 'per_slab_increment_percent',
                'name' => 'Per Slab Increment Percent',
                'type' => 'number',
                'group' => 'general',
                'value' => '7.5'
            ],

            // Salary Settings
            [
                'key' => 'total_salary_slab',
                'name' => 'Total Salary Slab',
                'type' => 'number',
                'group' => 'salary',
                'value' => '12'
            ],
            [
                'key' => 'salary_slab_consolidated',
                'name' => 'Salary Slab (Consolidated)',
                'type' => 'number',
                'group' => 'salary',
                'value' => '2'
            ],

            // Transfer Settings
            [
                'key' => 'zone_layer_name',
                'name' => 'Zone Layer Name',
                'type' => 'select',
                'group' => 'transfer',
                'value' => 'Zone'
            ],
            [
                'key' => 'transferable_month_at_zone',
                'name' => 'Transferable Month at Zone',
                'type' => 'number',
                'group' => 'transfer',
                'value' => '6'
            ],
            [
                'key' => 'branch_layer_name',
                'name' => 'Branch Layer Name',
                'type' => 'select',
                'group' => 'transfer',
                'value' => 'Branch'
            ],
        ];



        foreach ($settings as $setting) {
            Setting::create(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
