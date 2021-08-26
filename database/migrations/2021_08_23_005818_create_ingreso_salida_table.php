<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_salida', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_hora');
            $table->char('type', 1);
            $table->string('nota')->nullable();
            $table->unsignedBigInteger('habitacion_huesped_id');
            $table->timestamps();

            $table->foreign('habitacion_huesped_id')->references('id')->on('habitacion_huesped')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso_salida');
    }
}
