<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->unique()
                ->constrained()
                ->onDelete('cascade');

            // ── HERO ─────────────────────────────────
            $table->string('hero_badge')->nullable();
            // "Editor's Pick"
            $table->string('banner_image')->nullable();
            // Hero background image
            $table->longText('description')->nullable();
            // Rich text paragraphs

            // ── HIGHLIGHTS GRID ───────────────────────
            // [{ "icon": "bi-sunrise", "title": "...", "subtitle": "..." }]
            $table->json('highlights')->nullable();

            // ── AMENITIES GRID ────────────────────────
            // [{ "icon": "bi-wifi", "label": "Free WiFi" }]
            $table->json('amenities')->nullable();

            // ── PRICING CARD ──────────────────────────
            // packages.total_price  → final price  ✓
            // packages.advance_price → advance      ✓

            $table->string('offer_badge_text')->nullable();
            // "🔥 Save ₹3,000 — Limited Offer"
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('map_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};
