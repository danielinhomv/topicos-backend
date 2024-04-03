<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ganador_id')->nullable();
            $table->unsignedBigInteger('juego_id');
            $table->unsignedMediumInteger('monto_maximo');
            $table->unsignedMediumInteger('oferta_mayor')->nullable();
            $table->timestamps();
            $table->foreign('juego_id')->references('id')->on('juegos')->onDelete('cascade');
            $table->foreign('ganador_id')->references('id')->on('participantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
};
