<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'key' => 'site_name',
                'value' => 'Portfolio',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_driver',
                'value' => 'smtp',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_port',
                'value' => '587',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_username',
                'value' => 'faysaltibro@gmail.com',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_password',
                'value' => 'wxyxtcbeeonmwcuc',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'faysaltibro@gmail.com',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'mail_receive_address',
                'value' => 'faysaltibro@gmail.com',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'github_client_id',
                'value' => 'Ov23liCN96tlIvFlzFa5',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'github_client_secret',
                'value' => 'f1aae3ff64caa7325ba40ed375acb5f3e39815dd',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'github_redirect_url',
                'value' => 'http://127.0.0.1:8000/auth/github-callback',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
                        [
                'key' => 'google_client_id',
                'value' => 'Tibro',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'google_client_secret',
                'value' => 'Tibro',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'key' => 'google_redirect_url',
                'value' => 'http://127.0.0.1:8000/auth/google-callback',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
