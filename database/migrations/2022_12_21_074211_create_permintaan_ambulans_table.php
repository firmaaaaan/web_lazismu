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
        Schema::create('permintaan_ambulans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_pasien');
            $table->string('jk');
            $table->string('tanggal');
            $table->text('titik_jemput');
            $table->integer('rumahsakit_id');
            $table->integer('infaq')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('status_perjalanan')->nullable();
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
        Schema::dropIfExists('permintaan_ambulans');
    }
};