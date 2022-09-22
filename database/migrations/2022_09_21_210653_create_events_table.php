<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('country_id');
            $table->integer('category_id');
            $table->string('tags');
            $table->bigInteger('start_date_int');
            $table->integer('start_date_time_unit');
            $table->string('start_date_str');
            $table->bigInteger('end_date_int');
            $table->integer('end_date_time_unit');
            $table->string('end_date_str');
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
        Schema::dropIfExists('events');
    }
};
