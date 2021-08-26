<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionHuespedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion_huesped', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nota')->nullable();
            $table->dateTime('fecha_hora_ingreso');
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->char('estado', 1)->default('A');
            $table->unsignedBigInteger('habitacion_id');
            $table->unsignedBigInteger('huesped_id');
            $table->timestamps();
            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade');
            $table->foreign('huesped_id')->references('id')->on('huesped')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitacion_huesped');
    }
}
