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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('nama_donatur')->nullable();
            $table->integer('id_akun')->nullable();
            $table->integer('programdonasi_id')->nullable();
            $table->integer('jml_donasi')->nullable();
            $table->string('no_rek')->nullable();
            $table->bigInteger('hak_amil')->default(0);
            $table->text('keterangan')->nullable();
            $table->text('desk_penyaluran')->nullable();
            $table->string('status_penyaluran')->nullable();
            $table->integer('status_id')->nullable();
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
        Schema::dropIfExists('donasis');
    }
};