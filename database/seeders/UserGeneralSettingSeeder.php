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
            'header_title' => 'Welcome to my professional portfolio!',
            'header_description' => "<p>I am a passionate <strong>Full Stack </strong>and<strong> MERN Stack</strong> developer with expertise in creating dynamic and responsive web applications. With a strong background in both front-end and back-end development, I specialize in building scalable solutions using technologies like React, Node.js, Laravel, and more. Explore my projects to see how I turn ideas into impactful digital experiences. Let's connect and create something amazing together!</p>",
            'nav_items' => json_encode(['about', 'skills', 'resume', 'services', 'portfolio', 'project', 'testimonials', 'contact']), // JSON array
            'employment_type' => 'Freelance',
            'is_freelancer' => true,
            'hourly_rate_min' => 25.00,
            'hourly_rate_max' => 75.00,
            'currency_type' => 'USD',
            'contact_title' => 'Contact Us',
            'contact_description' => "Thank you for visiting my portfolio! If you have any questions, would like to discuss a project, or are interested in collaborating, please don't hesitate to reach out. You can contact me via the form below or through any of my social media channels. I look forward to connecting with you and exploring new opportunities together!",
            'number1' => '9453928078',
            'number2' => null,
            'email1' => 'er.surajkumar1999@gmail.com',
            'email2' => null, 
            'address' => 'Sector D1, LDA Colony',
            'city' => 'Lucknow',
            'state' => "Uttar Pradesh",
            'country' => 'India',
            'copyright_description' => '© 2024 Your Company. All rights reserved.',
            'theme_color' => 'emerald',
        ]);
    }
}
