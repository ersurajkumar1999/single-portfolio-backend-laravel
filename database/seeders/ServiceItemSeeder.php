<?php

namespace Database\Seeders;

use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceItems = [
            [
                'service_id' => 1,
                'icon' => 'fa-icon-3',
                'name' => 'Service 1',
                'description' => 'Description of Service 1.',
                'status' => true,
            ],
            [
                'service_id' => 1,
                'icon' => 'fa-icon-3',
                'name' => 'Service 2',
                'description' => 'Description of Service 2.',
                'status' => true,
            ],
        ];

        foreach ($serviceItems as $item) {
            ServiceItem::create($item);
        }
    }
}
