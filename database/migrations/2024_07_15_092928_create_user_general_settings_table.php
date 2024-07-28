<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            // $table->string('app_name');
            $table->string('header_title');
            $table->text('header_description');
            $table->string('banner_image');
            $table->json('nav_items'); // JSON column for array storage
            $table->enum('employment_type', [
                'Full-time',
                'Part-time',
                'Self-employed',
                'Freelance',
                'Internship',
                'Trainee'
            ])->nullable();
            $table->boolean('is_freelancer')->default(false);
            $table->decimal('hourly_rate_min', 8, 2)->nullable();
            $table->decimal('hourly_rate_max', 8, 2)->nullable();
            $table->string('currency_type')->default('USD');
            $table->string('contact_title');
            $table->string('contact_description');
            $table->string('number1');
            $table->string('number2')->nullable();
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->text('copyright_description');
            $table->text('theme_color')->default('emerald');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_general_settings');
    }
};
