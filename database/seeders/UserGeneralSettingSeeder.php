<?php

namespace Database\Seeders;

use App\Models\UserGeneralSetting;
use Illuminate\Database\Seeder;

class UserGeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserGeneralSetting::create([
            'user_id' => 1,
            'app_name' => 'Your App Name',
            'banner_image' => 'path/to/banner.jpg',
            'header_title' => 'Welcome to Your Website',
            'header_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'nav_items' => json_encode(['about', 'skills', 'resume', 'services', 'portfolio', 'testimonials', 'contact']),
            'contact_title' => 'Contact Us',
            'contact_description' => 'Get in touch with us for any inquiries.',
            'social_links' => json_encode([
                ["name" => 'whatsapp', 'icon' => '', 'link' => ''],
                ["name" => 'facebook', 'icon' => '', 'link' => ''],
                ["name" => 'twitter', 'icon' => '', 'link' => ''],
                ["name" => 'instagram', 'icon' => '', 'link' => ''],
                ["name" => 'linkedIn', 'icon' => '', 'link' => ''],
            ]),
            'number1' => '1234567890',
            'number2' => null,
            'email1' => 'info@example.com',
            'email2' => null,
            'address' => '123 Main St, City, Country',
            'copyright_description' => '© 2024 Your Company. All rights reserved.',
            'theme_color' => 'emerald',
        ]);
    }
}
