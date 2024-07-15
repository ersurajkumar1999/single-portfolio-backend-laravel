<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            AboutSeeder::class,
            AboutItemSeeder::class,
            SkillSeeder::class,
            SkillItemSeeder::class,
            UserResumeSeeder::class,
            ServiceSeeder::class,
            ServiceItemSeeder::class,
            PortfoliosTableSeeder::class,
            TestimonialSeeder::class,
            TestimonialItemSeeder::class,
            UserGeneralSettingSeeder::class,
        ]);
    }
}
