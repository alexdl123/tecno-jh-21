<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('habitacion_id');
            $table->foreign('habitacion_id')->references('id')
            ->on('habitaciones')->onDelete('cascade');
            $table->unsignedBigInteger('reserva_id');
            $table->foreign('reserva_id')->references('id')
            ->on('reserva')->onDelete('cascade');
            $table->date('fecha');
            $table->softDeletes();
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
        Schema::dropIfExists('det_reserva');
    }
}
