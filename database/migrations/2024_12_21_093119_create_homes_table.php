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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable(); // For the full name, e.g., 'Abdulrhman Herzallah'
            $table->string('profile_image')->nullable(); // Profile picture/logo
            $table->string('specialization')->nullable(); // Specialization title, e.g., 'Software Developer'
            $table->string('greeting_title')->nullable(); // Welcome title, e.g., 'Hello, I’m'
            $table->text('bio')->nullable(); // Larger description of the person
            $table->json('social_media')->nullable(); // Social media links, stored as JSON
            $table->json('stats')->nullable(); // Numbers like experience, projects, technologies
            $table->string('resume_file')->nullable(); // CV or resume file location
            $table->boolean('is_public')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
