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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('url')->nullable();

            $table->string('background');
            $table->text('description');
            $table->text('sub_description')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_public')->default(true);

            $table->unsignedInteger('sort')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
