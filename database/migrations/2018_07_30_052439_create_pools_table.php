<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pools', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('start_location', 100)->nullable();
            $table->string('start_longitude', 20)->nullable();
            $table->string('start_latitude', 20)->nullable();
            $table->string('end_location', 100)->nullable();
            $table->string('end_longitude', 20)->nullable();
            $table->string('end_latitude', 20)->nullable();
            $table->string('timeframe', 10)->nullable();
            $table->string('preference', 20)->nullable();
            $table->string('num_of_poolers', 3)->nullable();
            $table->string('luggage_capacity', 4)->nullable();
            $table->string('expected_fare', 5)->nullable();
            $table->string('per_person_fare', 5)->nullable();
            $table->string('seats_full', 3)->nullable()->default(0);
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
        Schema::dropIfExists('pools');
    }
}
