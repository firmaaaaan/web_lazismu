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
        Schema::create('log_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('id_programdonasi_asal')->nullable();
            $table->unsignedBigInteger('id_programdonasi_tujuan')->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->string('keterangan')->nullable();
            $table->foreign('id_programdonasi_asal')->references('id')->on('program_donasis');
            $table->foreign('id_programdonasi_tujuan')->references('id')->on('program_donasis');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('log_transaksis');
    }
};