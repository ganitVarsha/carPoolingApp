<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('app_user_id', 20);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('gender',['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('isd', 5)->default('+91');
            $table->string('phone', 15)->unique();
            $table->string('profession', 50)->nullable();
            $table->enum('nature',['extro', 'intro'])->nullable();
            $table->rememberToken();
            $table->longText('api_token')->nullable();
            $table->tinyInteger('isAdmin')->default('0');
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
