<?php

namespace Database\Seeders;

use App\Models\AboutItem;
use Illuminate\Database\Seeder;

class AboutItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutItems = [
            [
                'about_id' => 1,
                'icon' => 'fa-icon-1',
                'number' => 10,
                'text' => 'First item description.',
            ],
            [
                'about_id' => 1,
                'icon' => 'fa-icon-2',
                'number' => 20,
                'text' => 'Second item description.',
            ],
            [
                'about_id' => 1,
                'icon' => 'fa-icon-3',
                'number' => 30,
                'text' => 'Third item description.',
            ],
            [
                'about_id' => 1,
                'icon' => 'fa-icon-4',
                'number' => 30,
                'text' => 'Four item description.',
            ],
        ];

        foreach ($aboutItems as $item) {
            AboutItem::create($item);
        }
    }
}
