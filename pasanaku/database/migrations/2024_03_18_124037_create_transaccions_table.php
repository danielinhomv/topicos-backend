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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realiza_participante_id');
            $table->unsignedBigInteger('recibe_participante_id')->nullable();
            $table->string('pdf_uri');
            $table->string('image_uri'); 
            $table->timestamps();
            $table->foreign('realiza_participante_id')->references('id')->on('participantes');
            $table->foreign('recibe_participante_id')->references('id')->on('participantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaccions');
    }
};
