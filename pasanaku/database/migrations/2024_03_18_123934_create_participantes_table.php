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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('juego_id');
            $table->string('rol')->nullable();
            $table->timestamps();
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('juego_id')->references('id')->on('juegos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participantes');
    }
};
