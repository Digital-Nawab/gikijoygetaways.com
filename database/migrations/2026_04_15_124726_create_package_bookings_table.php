<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            // ← ADDED: track where booking came from
            $table->enum('source', ['website', 'admin'])->default('website');

            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();

            $table->integer('adult')->default(1);
            $table->integer('child')->default(0);
            $table->integer('total_people');

            $table->date('checkin');
            $table->date('checkout');

            $table->text('message')->nullable();


            $table->enum('booking_status', ['pending', 'confirmed', 'cancelled'])
                ->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid'])
                ->default('unpaid');

            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_order_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
