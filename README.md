# Personal Portfolio Website

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x%2B-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)

A brief description of your Laravel project and its purpose.

## ✨ Features

-   HTML, CSS, Javascript
-   Ajax, OAuth
-   Facebook Login, Google Login
-   RESTful API endpoints
-   Authentication & Authorization
-   Database migrations & seeders
-   Task scheduling with Laravel Scheduler
-   Queue jobs for background processing
-   Real-time features with Laravel Echo (if applicable)

## 📋 Prerequisites

Before you begin, ensure you have met the following requirements:

-   PHP >= 8.2
-   Composer 2.8.12
-   Node.js >= 14 (if using frontend build tools)
-   NPM or Yarn
-   Database (MySQL)
-   Web server (Apache/Nginx) or PHP built-in server
-   Laravel Breeze

## 🚀 Installation

Follow these steps to set up the project locally:

1. **Clone the repository**

    ````bash
    git clone https://github.com/Tibro0/portfolio-two-laravel.git portfolio-two-laravel
    cd portfolio-two-laravel
    code .```

    ````

2. **Open App\Providers\CustomMailServiceProvider.php**

```bash
<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CustomMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $mailSetting = Cache::rememberForever('mail_settings', function () {
        //     return Setting::pluck('value', 'key')->toArray();
        // });

        // if ($mailSetting) {
        //     Config::set('app.name', $mailSetting['site_name']);

        //     Config::set('mail.mailers.smtp.host', $mailSetting['mail_host']);
        //     Config::set('mail.mailers.smtp.port', $mailSetting['mail_port']);
        //     Config::set('mail.mailers.smtp.username', $mailSetting['mail_username']);
        //     Config::set('mail.mailers.smtp.password', $mailSetting['mail_password']);
        //     Config::set('mail.from.address', $mailSetting['mail_from_address']);

        //     Config::set('services.github.client_id', $mailSetting['github_client_id']);
        //     Config::set('services.github.client_secret', $mailSetting['github_client_secret']);
        //     Config::set('services.github.redirect', $mailSetting['github_redirect_url']);

        //     Config::set('services.google.client_id', $mailSetting['google_client_id']);
        //     Config::set('services.google.client_secret', $mailSetting['google_client_secret']);
        //     Config::set('services.google.redirect', $mailSetting['google_redirect_url']);
        // }
    }
}
```

3. **Open App\Providers\SettingsServiceProvider.php**

```bash
<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->singleton(SettingsService::class, function () {
        //     return new SettingsService();
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $settingsService = $this->app->make(SettingsService::class);
        // $settingsService->setGlobalSettings();
    }
}
```

4. **Install PHP Dependencies**

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

5. **Configure Environment Variables**
   Edit the .env file with your database credentials and other settings:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run database migrations and seeders**

```bash
php artisan migrate:fresh --seed
npm run dev
npm run build
```

7. **Start The Development Server**

```bash
php artisan serve
```

8. **Access The Application**

```bash
http://127.0.0.1:8000/
```
