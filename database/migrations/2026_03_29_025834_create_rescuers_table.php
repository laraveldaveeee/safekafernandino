<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescuers', function (Blueprint $table) {
            $table->id();
            $table->integer('emergency_id')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('type')->nullable();
            $table->string('gender')->nullable();;
            $table->string('mobile')->nullable();
            $table->string('language')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('station_location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('contact')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_id_verified')->nullable();
            $table->string('valid_id_path')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('rescuers');
    }
}
