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
            'user_id' => 1,  // Ensure this user ID exists in the users table
            'banner_image' => asset('assets/images/default.png'),
            'header_title' => 'Welcome to Your Website',
            'header_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'nav_items' => json_encode(['about', 'skills', 'resume', 'services', 'portfolio', 'project', 'testimonials', 'contact']), // JSON array
            'employment_type' => 'Freelance', // Example value, adjust as needed
            'is_freelancer' => true, // Example boolean value
            'hourly_rate_min' => 25.00, // Example minimum hourly rate
            'hourly_rate_max' => 75.00, // Example maximum hourly rate
            'currency_type' => 'USD', // Default currency type
            'contact_title' => 'Contact Us',
            'contact_description' => 'Get in touch with us for any inquiries.',
            'number1' => '1234567890',
            'number2' => '0987654321', // Example optional number
            'email1' => 'info@example.com',
            'email2' => 'support@example.com', // Example optional email
            'address' => '123 Main St, City, Country',
            'city' => 'CityName', // Example value
            'state' => 'StateName', // Example value
            'country' => 'CountryName', // Example value
            'copyright_description' => '© 2024 Your Company. All rights reserved.',
            'theme_color' => 'emerald', // Default theme color
        ]);
    }
}
