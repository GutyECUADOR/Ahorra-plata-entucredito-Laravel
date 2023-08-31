<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inversions', function (Blueprint $table) {
            $table->id();
            $table->decimal('tasa',4,2);
            $table->integer('dias_inversion');
            $table->decimal('monto', 9,2);
            $table->decimal('monto_recibir', 9,2)->nullable();
            $table->date('fecha_inversion');
            $table->date('fecha_pago')->nullable();
            $table->string('imagen_recibo');
            $table->unsignedBigInteger('user_id');
            $table->string('estado');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inversions');
    }
}
