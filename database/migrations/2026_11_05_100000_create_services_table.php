<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // One row per capability area (A–G).
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Display letter shown in the portfolio: A, B, C ...
            $table->string('code', 5)->nullable();

            $table->string('slug', 150)->unique();
            $table->string('title', 200);
            $table->text('description');

            // Icon identifier used by the frontend (e.g. "compass").
            $table->string('icon', 100)->nullable();

            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });

        // Bullet points that belong to a service.
        // `group_title` is optional and lets one service split its bullets
        // into sub-sections (e.g. "Process Consulting" / "Operating Model").
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('group_title', 200)->nullable();
            $table->string('title', 250);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['service_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_items');
        Schema::dropIfExists('services');
    }
};
