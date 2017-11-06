<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_proyecto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('id_proyecto')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_proyecto')->references('id')->on('proyecto')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('comentarios_proyecto');
    }
}
