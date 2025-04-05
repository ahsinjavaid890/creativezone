<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->nullable();
            $table->string('tittle')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nationality')->nullable();
            $table->string('dob')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->string('category_id')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('emirates_id')->nullable();
            $table->string('prefered_way_communication')->nullable();
            $table->string('term_and_condition_acceptance')->nullable();
            $table->string('registration_payment')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
}
