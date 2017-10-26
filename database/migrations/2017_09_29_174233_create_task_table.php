<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 30);            
            $table->string('description', 100);
            //$table->string('movimiento', 100);
            $table->enum('estado', ['BackLog Proyecto', 'BackLog Usuario','En Proceso'])->default('BackLog Proyecto');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_fin');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_proyecto')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_proyecto')->references('id')->on('proyecto')->onDelete('cascade');
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
        Schema::dropIfExists('task');
    }
}
