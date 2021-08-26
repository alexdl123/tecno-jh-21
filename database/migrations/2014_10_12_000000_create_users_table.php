<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->mediumText('foto')->nullable();
            $table->date('fecha');
            $table->tinyInteger('tema')->default(1);
            $table->tinyInteger('tipo_letra')->default(1);
            $table->tinyInteger('tamano')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('rol_id')->default(3);
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
