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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // NEW FIELDS 👇
            $table->string('short_description')->nullable();
            $table->string('location')->nullable();
            $table->string('nights')->nullable();

            $table->unsignedTinyInteger('guests')->default(1);
            $table->unsignedTinyInteger('bedrooms')->default(1);
            $table->unsignedTinyInteger('beds')->default(1);
            $table->unsignedTinyInteger('bathrooms')->default(1);
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->boolean('is_guest_favourite')->default(0);

            $table->string('image')->nullable();

            // Location (RELATION)
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();

            // Travel Info
            $table->string('days');

            // Pricing
            $table->decimal('total_price', 10, 2);
            $table->decimal('advance_price', 10, 2)->nullable();

            // Extra
            $table->string('tag')->nullable();

            // Status
            $table->boolean('status')->default(1);
            $table->softDeletes();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
