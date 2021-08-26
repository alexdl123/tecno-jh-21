<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')
            ->on('categoria')->onDelete('cascade');
            $table->unsignedBigInteger('opcion_id');
            $table->foreign('opcion_id')->references('id')
            ->on('opciones')->onDelete('cascade');
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
        Schema::dropIfExists('det_categoria');
    }
}
