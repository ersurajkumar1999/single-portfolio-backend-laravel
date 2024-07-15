<?php

namespace Database\Seeders;

use App\Models\UserResume;
use Illuminate\Database\Seeder;

class UserResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resume = UserResume::create([
            'user_id' => 1,
            'title' => 'Resume',
            'description' => 'Magnam dolores commodi suscipit...',
            'summary_heading' => 'Summary',
            'summary_title' => 'Alice Barkley',
            'summary_content' => 'Innovative and deadline-driven Graphic Designer...',
        ]);

        $educationEntries = [
            [
                'course_name' => 'Master in Electronics',
                'batch' => '2015 - 2016',
                'course_content' => 'Rochester Institute of Technology, Rochester, NY...',
            ],
            [
                'course_name' => 'Bachelor of Fine Arts & Graphic Design',
                'batch' => '2010 - 2014',
                'course_content' => 'Delhi Institute of Technology, Rochester, NY...',
            ],
        ];

        foreach ($educationEntries as $education) {
            $resume->educationEntries()->create($education);
        }

        $experienceEntries = [
            [
                'job_role' => 'Senior Graphic Design Specialist',
                'duration' => '2019 - Present',
                'location' => 'Experion, New York, NY',
                'job_description' => 'Lead in the design, development, and implementation...',
            ],
            [
                'job_role' => 'Graphic Design Specialist',
                'duration' => '2017 - 2018',
                'location' => 'Stepping Stone Advertising, New York, NY',
                'job_description' => 'Developed numerous marketing programs...',
            ],
        ];

        foreach ($experienceEntries as $experience) {
            $resume->experienceEntries()->create($experience);
        }
    }
}
