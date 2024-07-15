<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create([
            'user_id' => 1,
            'title' => 'Programming',
            'description' => 'Programming related skills',
        ]);
    }
}
