<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'user_id' => 1,
            'image' => 'path/to/image.jpg',
            'title' => 'About Us',
            'description' => 'This is the about us description.',
        ]);
    }
}
