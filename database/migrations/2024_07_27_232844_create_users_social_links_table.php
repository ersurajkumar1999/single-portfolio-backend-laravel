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
        Schema::create('users_social_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('portfolio_id');
            $table->string('platform');
            $table->string('icon');
            $table->string('link');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_social_links');
    }
};
