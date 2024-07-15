<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResumesTable extends Migration
{
    public function up()
    {
        Schema::create('user_resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('summary_heading');
            $table->string('summary_title');
            $table->text('summary_content');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('education_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id');
            $table->string('course_name');
            $table->string('batch');
            $table->text('course_content');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
        });

        Schema::create('experience_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id');
            $table->string('job_role');
            $table->string('duration');
            $table->string('location');
            $table->text('job_description');
            $table->boolean('status')->default(true);
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('resume_id')->references('id')->on('user_resumes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('experience_entries');
        Schema::dropIfExists('education_entries');
        Schema::dropIfExists('user_resumes');
    }
}
