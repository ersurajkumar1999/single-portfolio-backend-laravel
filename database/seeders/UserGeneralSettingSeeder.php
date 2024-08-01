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
            'banner_image' => asset('assets/images/default-banner.jpg'),
            'header_title' => 'Welcome to Your Website',
            'header_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'nav_items' => json_encode(['about', 'skills', 'resume', 'services', 'portfolio', 'project', 'testimonials', 'contact']), // JSON array
            'employment_type' => 'Freelance',
            'is_freelancer' => true,
            'hourly_rate_min' => 25.00,
            'hourly_rate_max' => 75.00,
            'currency_type' => 'USD',
            'contact_title' => 'Contact Us',
            'contact_description' => 'Get in touch with us for any inquiries.',
            'number1' => '1234567890',
            'number2' => '0987654321',
            'email1' => 'info@example.com',
            'email2' => 'support@example.com', 
            'address' => '123 Main St, City, Country',
            'city' => 'CityName',
            'state' => 'StateName',
            'country' => 'CountryName',
            'copyright_description' => '© 2024 Your Company. All rights reserved.',
            'theme_color' => 'emerald',
        ]);
    }
}
