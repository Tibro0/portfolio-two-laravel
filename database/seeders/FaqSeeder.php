<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::insert([
            [
                'question' => 'Why do you prefer Laravel over other PHP frameworks?',
                'answer' => 'Laravel provides an elegant syntax and a robust set of tools (Eloquent ORM, Blade templating, Artisan CLI) that dramatically speed up development while ensuring code is maintainable and secure. Its massive ecosystem and strong community support make it the best choice for building modern, scalable web applications.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How do you handle security in your Laravel applications?',
                'answer' => "Security is a priority. I leverage Laravel's built-in protections against common vulnerabilities like SQL injection, Cross-Site Request Forgery (CSRF), and Cross-Site Scripting (XSS). I also implement best practices such as input validation, parameter binding, secure authentication, and proper user role/permission management.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Can you integrate third-party APIs?',
                'answer' => "Absolutely. I have extensive experience integrating various RESTful and SOAP APIs for payment gateways (Stripe, PayPal), email services (Mailchimp, SendGrid), SMS services, and mapping services (Google Maps) into Laravel applications.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Do you work with databases besides MySQL?',
                'answer' => "While MySQL/PostgreSQL are the most common databases used with Laravel, I am also proficient in working with SQLite for development/testing and have experience with MongoDB for NoSQL-based projects.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'What is your experience with Laravel Livewire or Alpine.js?',
                'answer' => "I have practical experience using both Livewire and Alpine.js to create dynamic, modern interfaces without the complexity of a full frontend framework like Vue or React. This allows me to build highly interactive features while staying within the productive Laravel ecosystem.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Do you code designs from scratch or use templates?',
                'answer' => "I am skilled in both. I can expertly convert a Figma/Adobe XD design mockup into clean, semantic HTML/CSS code. I also effectively use and customize Bootstrap 5 templates to accelerate development while ensuring a unique and professional final product that matches your brand.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Why do you use Bootstrap 5?',
                'answer' => 'Bootstrap 5 provides a powerful, mobile-first grid system and a comprehensive component library. It ensures the websites I build are fully responsive, consistent across browsers, and developed efficiently. I am proficient in customizing it with Sass to match any design language, avoiding the "generic Bootstrap look."',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Is the website you build for me going to be responsive?',
                'answer' => 'Absolutely. Every website I develop is built with a "mobile-first" approach. This means your site will provide an optimal viewing and interaction experience—easy reading and navigation with minimal resizing, panning, and scrolling—across a wide range of devices (from mobile phones to desktop monitors)."',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'How do you ensure website performance and fast loading times?',
                'answer' => 'I optimize frontend performance by minifying CSS/JS, optimizing images (using modern formats like WebP), leveraging browser caching, and writing efficient code. For Laravel, I use techniques like eager loading, caching queries, and asset compression to ensure swift backend performance.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question' => 'Do you work with JavaScript frameworks like React or Vue.js?',
                'answer' => "My core frontend expertise lies in creating robust interfaces with HTML, CSS, and Bootstrap 5, often enhanced with vanilla JavaScript and Alpine.js for interactivity. For projects requiring a complex Single Page Application (SPA), I can collaborate with a dedicated React/Vue developer or utilize Laravel's API capabilities to serve a separate frontend.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
