<?php

namespace Database\Seeders;

use App\Models\SkillItem;
use Illuminate\Database\Seeder;

class SkillItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skillItems = [
            [
                'skill_id' => 1,
                'name' => 'PHP',
                'value' => 90,
                'status' => true,
            ],
            [
                'skill_id' => 1,
                'name' => 'JavaScript',
                'value' => 95,
                'status' => true,
            ],
            [
                'skill_id' => 1,
                'name' => 'Python',
                'value' => 85,
                'status' => true,
            ],
            [
                'skill_id' => 1,
                'name' => 'Java',
                'value' => 85,
                'status' => true,
            ]
        ];

        foreach ($skillItems as $item) {
            SkillItem::create($item);
        }
    }
}
