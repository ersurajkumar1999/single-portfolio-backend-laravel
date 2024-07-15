<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'user_id' => 1,
            'title' => 'Client Testimonials',
            'description' => 'Testimonials from our valued clients.',
        ]);
    }
}
