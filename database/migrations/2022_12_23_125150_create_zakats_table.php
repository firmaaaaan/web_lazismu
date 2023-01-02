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
        Schema::create('zakats', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal')->nullable();
            $table->integer('nominal_beras')->nullable();
            $table->integer('jumlah_tersisa')->nullable();
            $table->string('status_penyaluran')->nullable();
            $table->integer('donasi_tersalurkan')->nullable();
            $table->string('jenis_zakat');
            $table->string('no_rek')->nullable();
            $table->text('keterangan');
            $table->integer('status_id')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('zakats');
    }
};