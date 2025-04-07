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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('smallname')->nullable();
            $table->string('site_name')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phonenumber')->nullable();
            $table->string('email_template')->nullable();
            $table->string('buynow_form')->nullable();
            $table->string('userpanel_temp')->nullable();
            $table->string('site_fax')->nullable();
            $table->string('site_address')->nullable();
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('metta_tittle')->nullable();
            $table->string('metta_description')->nullable();
            $table->string('metta_keywords')->nullable();
            $table->string('metta_image')->nullable();
            $table->string('cookies_content')->nullable();
            $table->string('show_cookies_aggrement')->nullable();
            $table->longText('footer_description')->nullable();
            $table->string('top_navbar')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
