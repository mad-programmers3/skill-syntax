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
        Setting::insert([
            ['name' => 'Enable Registration', 'key' => 'is_enable_registration', 'type' => 'select', 'group' => '1', 'value' => '1', 'status' => 1],
            ['name' => 'Enable Login', 'key' => 'is_enable_login', 'type' => 'select', 'group' => '1', 'value' => '1', 'status' => 1],
            ['name' => 'Job Post to Futurenation Platform', 'key' => 'is_job_post_to_futurenation', 'type' => 'select', 'group' => '7', 'value' => '1', 'status' => 1],
            ['name' => 'Futurenation API Key', 'key' => 'futurenation_api_key', 'type' => 'text', 'group' => '7', 'value' => 'your_api_key', 'status' => 1],
            ['name' => 'Futurenation Client Secret', 'key' => 'futurenation_client_secret', 'type' => 'text', 'group' => '7', 'value' => 'your_client_secret', 'status' => 1],
        ]);
    }
}
