<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleAndPlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_and_planets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('height');
            $table->string('mass');
            $table->string('hair_color');
            $table->string('skin_color');
            $table->string('eye_color');
            $table->string('birth_year');
            $table->string('gender');
            $table->json('homeworld');
            $table->json('films');
            $table->json('species');
            $table->json('vehicles');
            $table->json('starships');
            $table->string('url');
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
        Schema::dropIfExists('people_and_planets');
    }
}
