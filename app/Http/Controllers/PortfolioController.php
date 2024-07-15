<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolio = Portfolio::create([
            'title' => 'Portfolio',
            'description' => 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.',
        ]);

        $images = [
            ['name' => 'app', 'image' => 'image/app1.jpg'],
            ['name' => 'web', 'image' => 'image/web2.jpg'],
            ['name' => 'card', 'image' => 'image/card2.jpg'],
            ['name' => 'app', 'image' => 'image/app3.jpg'],
            ['name' => 'card', 'image' => 'image/card3.jpg'],
            ['name' => 'web', 'image' => 'image/web3.jpg'],
            ['name' => 'app', 'image' => 'image/app2.jpg'],
            ['name' => 'web', 'image' => 'image/web1.jpg'],
            ['name' => 'card', 'image' => 'image/card1.jpg'],
        ];

        foreach ($images as $image) {
            PortfolioItem::create([
                'portfolio_id' => $portfolio->id,
                'name' => $image['name'],
                'image' => $image['image'],
            ]);
        }
    }
}
