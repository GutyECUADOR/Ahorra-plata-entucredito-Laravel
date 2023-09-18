<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilaPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fila_prestamos', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->bigInteger('aextracapital');
            $table->unsignedBigInteger('credito_id');
            $table->timestamps();
            $table->foreign('credito_id')->references('id')->on('creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fila_prestamos');
    }
}
