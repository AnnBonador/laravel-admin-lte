<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->references('id')->on('clinics');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->unsigned()->references('id')->on('users')->onDelete('cascade');
            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('duration');
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
        Schema::dropIfExists('schedules');
    }
}
