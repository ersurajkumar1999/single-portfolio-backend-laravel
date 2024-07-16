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
            $table->string('app_name');
            $table->string('banner_image');
            $table->string('header_title');
            $table->text('header_description');
            $table->json('nav_items'); // JSON column for array storage
            $table->string('contact_title');
            $table->string('contact_description');
            $table->json('social_links'); // JSON column for object storage
            $table->string('number1');
            $table->string('number2')->nullable();
            $table->string('email1');
            $table->string('email2')->nullable();
            $table->string('address');
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
