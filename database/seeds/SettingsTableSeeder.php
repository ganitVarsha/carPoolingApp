<?php

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
        DB::table('settings')->insert([
            [
                'scope' => 'Web',
                'settings_name' => 'logo',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'title_bar',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'favicon_icon',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'facebook_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'google_plus_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'twitter_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Web',
                'settings_name' => 'linkedin_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'about_us',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'contact_us',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'terms_and_conditions',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'privacy_policies',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'refund_policies',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'Page',
                'settings_name' => 'faq',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'App',
                'settings_name' => 'radius',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'App',
                'settings_name' => 'google_api_key',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'App',
                'settings_name' => 'play_store_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'scope' => 'App',
                'settings_name' => 'app_store_link',
                'value' => '',
                'is_active' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
