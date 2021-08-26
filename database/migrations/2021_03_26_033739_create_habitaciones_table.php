<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nrohabitacion');
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('estado')->default('Disponible');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')
            ->on('categoria')->onDelete('cascade');
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
        Schema::dropIfExists('habitaciones');
    }
}
