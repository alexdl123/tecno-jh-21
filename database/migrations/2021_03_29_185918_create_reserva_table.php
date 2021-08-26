<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('huesped_id');

            $table->foreign('huesped_id')->references('id')
            ->on('huesped')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('promocion_id')->nullable();

            $table->foreign('promocion_id')->references('id')
            ->on('promocion')->onDelete('cascade');
            
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
        Schema::dropIfExists('reserva');
    }
}
