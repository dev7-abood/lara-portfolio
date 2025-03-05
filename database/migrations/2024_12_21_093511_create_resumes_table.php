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
            $table->json('experiences');
            $table->text('description')->nullable(); // Details about the experience
            $table->string('link')->nullable(); // e.g., 'https://cerebra.sa'
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();

            $table->timestamps();
        });

        // Education table
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->json('educations');
            $table->text('description')->nullable(); // Optional details
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();
            $table->timestamps();
        });

        // Skills table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->json('skills')->nullable(); // Path or reference to an icon
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort')->index()->nullable();
            $table->timestamps();
        });

        // About Me table
        Schema::create('about_mes', function (Blueprint $table) {
            $table->id();
            $table->json('contact_details');
            $table->tinyText('description')->nullable();
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
