<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AllApiCredentialController extends Controller
{
    public static function googleApiSetting()
    {
        $googleSetting = Setting::pluck('value', 'key')->toArray();

        Config::set('services.google.client_id', $googleSetting['google_client_id']);
        Config::set('services.google.client_secret', $googleSetting['google_client_secret']);
        Config::set('services.google.redirect', $googleSetting['google_redirect_url']);
    }

    public static function githubApiSetting()
    {
        $githubSetting = Setting::pluck('value', 'key')->toArray();

        Config::set('services.github.client_id', $githubSetting['github_client_id']);
        Config::set('services.github.client_secret', $githubSetting['github_client_secret']);
        Config::set('services.github.redirect', $githubSetting['github_redirect_url']);
    }

    public static function emailApiSetting()
    {
        $emailSettings = Setting::pluck('value', 'key')->toArray();

        Config::set('mail.mailers.smtp.host', $emailSettings['mail_host']);
        Config::set('mail.mailers.smtp.port', $emailSettings['mail_port']);
        Config::set('mail.mailers.smtp.username', $emailSettings['mail_username']);
        Config::set('mail.mailers.smtp.password', $emailSettings['mail_password']);
        Config::set('mail.from.address', $emailSettings['mail_from_address']);
    }
}
