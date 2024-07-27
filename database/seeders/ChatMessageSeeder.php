<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatMessage::create([
            'user_id' => 1,
            'from' => 'BOT',
            'message' => 'Welcome to the chat! How can I assist you today?',
        ]);
    }
}
