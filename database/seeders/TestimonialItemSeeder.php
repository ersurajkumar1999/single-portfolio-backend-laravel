<?php

namespace Database\Seeders;

use App\Models\TestimonialItem;
use Illuminate\Database\Seeder;

class TestimonialItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonialItems = [
            [
                'testimonial_id' => 1,
                'profession' => 'Web Developer',
                'name' => 'John Doe',
                'image' => asset('assets/images/default.png'),
                'feedback' => 'Great service! I highly recommend their expertise.',
                'status' => true,
            ],
            [
                'testimonial_id' => 1,
                'profession' => 'Designer',
                'name' => 'Jane Smith',
                'image' => asset('assets/images/default.png'),
                'feedback' => 'Very creative team. Delivered beyond my expectations.',
                'status' => true,
            ],
            // Add more items as needed
        ];

        foreach ($testimonialItems as $item) {
            TestimonialItem::create($item);
        }
    }
}
