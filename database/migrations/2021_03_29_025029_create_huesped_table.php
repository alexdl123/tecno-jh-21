<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuespedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huesped', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono');
            $table->date('fecha');
            $table->integer('ci')->nullable();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('huesped');
    }
}
