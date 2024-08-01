<?php

namespace Database\Seeders;

use App\Models\UserResume;
use App\Models\EducationEntry;
use App\Models\ExperienceEntry;
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
            'education_heading' => 'Education',
            'experience_heading' => 'Professional Experience',
        ]);

        $educationEntries = [
            [
                'user_id' => $resume->user_id,
                'course_name' => 'Master in Electronics',
                'batch' => '2015 - 2016',
                'course_content' => 'Rochester Institute of Technology, Rochester, NY...',
            ],
            [
                'user_id' => $resume->user_id,
                'course_name' => 'Bachelor of Fine Arts & Graphic Design',
                'batch' => '2010 - 2014',
                'course_content' => 'Delhi Institute of Technology, Rochester, NY...',
            ],
        ];

        foreach ($educationEntries as $education) {
            EducationEntry::create($education);
        }

        $experienceEntries = [
            [
                'user_id' => $resume->user_id,
                'job_role' => 'Senior Graphic Design Specialist',
                'duration' => '2019 - Present',
                'location' => 'Experion, New York, NY',
                'job_description' => 'Lead in the design, development, and implementation...',
            ],
            [
                'user_id' => $resume->user_id,
                'job_role' => 'Graphic Design Specialist',
                'duration' => '2017 - 2018',
                'location' => 'Stepping Stone Advertising, New York, NY',
                'job_description' => 'Developed numerous marketing programs...',
            ],
        ];

        foreach ($experienceEntries as $experience) {
            ExperienceEntry::create($experience);
        }
    }
}
