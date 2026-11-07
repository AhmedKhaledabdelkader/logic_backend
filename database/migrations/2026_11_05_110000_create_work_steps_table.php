<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // "How We Work" — one row per step of the consulting approach.
        // The displayed number (01, 02 ...) is derived from sort_order,
        // so reordering never leaves stale numbers behind.
        Schema::create('work_steps', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->text('description');

            // What the client gets at the end of this step.
            $table->text('outcome')->nullable();

            // Icon identifier used by the frontend (e.g. "search").
            $table->string('icon', 100)->nullable();

            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_steps');
    }
};
