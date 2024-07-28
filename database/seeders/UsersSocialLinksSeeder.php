<?php

namespace Database\Seeders;

use App\Models\UserSocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSocialLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialLinks = [
            [
                'platform' => 'Facebook',
                'icon' => 'fa-facebook',
                'link' => 'https://facebook.com/example',
                'status' => true,
            ],
            [
                'platform' => 'Twitter',
                'icon' => 'fa-twitter',
                'link' => 'https://twitter.com/example',
                'status' => true,
            ],
            [
                'platform' => 'LinkedIn',
                'icon' => 'fa-linkedin',
                'link' => 'https://linkedin.com/in/example',
                'status' => true,
            ],
            // Add more platforms as needed
        ];

            foreach ($socialLinks as $socialLink) {
                UserSocialLink::create([
                    'user_id' => 1,
                    'platform' => $socialLink['platform'],
                    'icon' => $socialLink['icon'],
                    'link' => $socialLink['link'],
                    'status' => $socialLink['status'],
                ]);
            }
    }
}
