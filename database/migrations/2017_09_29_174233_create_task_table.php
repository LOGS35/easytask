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
            $table->string('nombre', 50);            
            $table->string('description', 300);
            //$table->string('movimiento', 100);
            $table->enum('estado', ['BackLog Proyecto', 'BackLog Usuario','BackLog Revision','BackLog Aprobado'])->default('BackLog Proyecto');
            $table->integer('peso');
            $table->dateTime('fecha_fin')->nullable();
            $table->integer('id_usuario')->unsigned()->nullable();
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
