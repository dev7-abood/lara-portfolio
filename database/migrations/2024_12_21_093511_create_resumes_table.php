<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Experience table
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('role'); // e.g., 'Full Stack Developer'
            $table->string('company'); // e.g., 'Tech Solutions Inc.'
            $table->string('duration'); // e.g., '2022 - Present'
            $table->text('description')->nullable(); // Details about the experience
            $table->string('link')->nullable(); // e.g., 'https://cerebra.sa'
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();

            $table->timestamps();
        });

        // Education table
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('program'); // e.g., 'Full Stack Web Development Bootcamp'
            $table->string('institution'); // e.g., 'Online Course Platform'
            $table->string('duration'); // e.g., '2023'
            $table->text('description')->nullable(); // Optional details
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();
            $table->string('link')->nullable(); // e.g., 'cerebra.sa'
            $table->timestamps();
        });

        // Skills table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., 'HTML', 'CSS', 'JavaScript'
            $table->string('icon')->nullable(); // Path or reference to an icon

            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });

        // About Me table
        Schema::create('about_me', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., 'Luke Coleman'
            $table->string('experience')->nullable(); // e.g., '12+ Years'
            $table->string('nationality')->nullable(); // e.g., 'American'
            $table->string('freelance_status')->nullable(); // e.g., 'Available'
            $table->string('phone')->nullable(); // e.g., '+40 321 654 678'
            $table->string('email')->nullable(); // e.g., 'luke.01@gmail.com'
            $table->string('skype')->nullable(); // e.g., 'luke.01'
            $table->string('languages')->nullable(); // e.g., 'English, Spanish'
            $table->unsignedInteger('sort')->index()->nullable();
            $table->boolean('is_public')->default(true);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('about_me');
    }
};
