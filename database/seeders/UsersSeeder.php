<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'), // Secure password
            'email_verified_at' => now(),
            'gender' => 'Male', // Example gender
            'dob' => '1999-01-01', // Example date of birth
            'language' => json_encode(['English']), // Example languages
            'image' => asset('assets/images/default.png'), // Example profile image path
            'status' => true, // Active status
            'remember_token' => Str::random(10), // Random token for password reset
        ]);
    }
}
