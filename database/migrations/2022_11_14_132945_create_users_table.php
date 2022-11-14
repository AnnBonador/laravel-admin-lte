<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->nullable();
            $table->string('contact');
            $table->string('dob');
            $table->string('specialization_id')->nullable();
            $table->string('experience')->nullable();
            $table->string('gender');
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('type')->default(0);
            /* Users: 0=>User, 1=>Admin, 2=>Doctor */
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
