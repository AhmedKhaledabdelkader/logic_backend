<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            // Hero section
            $table->string('hero_title');
            $table->string('hero_subtitle');

            // Our Story section
            $table->string('story_title');
            $table->text('story_paragraph');
            $table->string('story_image')->nullable();

            // Our Presence — repeatable [{title, subtitle}, ...]
            $table->json('presence')->nullable();

            // What We Value — repeatable [{icon, title, subtitle}, ...]
            $table->json('values')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};