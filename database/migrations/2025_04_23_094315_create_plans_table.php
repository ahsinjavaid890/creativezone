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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('billing_cycle')->nullable();
            $table->string('features')->nullable();
            $table->string('priority_support')->nullable();
            $table->string('max_event_listings')->nullable();
            $table->string('trial_days')->nullable();
            $table->string('is_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
