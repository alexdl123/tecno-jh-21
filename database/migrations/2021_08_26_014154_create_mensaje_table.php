<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('titulo');
            $table->text('contenido');
            $table->dateTime('fechahora');
            $table->char('by');
            $table->unsignedBigInteger('huesped_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('huesped_id')->references('id')->on('huesped')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensaje');
    }
}
