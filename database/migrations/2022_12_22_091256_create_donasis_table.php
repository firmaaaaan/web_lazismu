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
            $table->integer('programdonasi_id');
            $table->integer('jml_donasi');
            $table->integer('jumlah_tersisa')->nullable();
            $table->integer('donasi_tersalurkan')->nullable();
            $table->string('no_rek');
            $table->text('keterangan');
            $table->string('status_penyaluran')->nullable();
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
        Schema::dropIfExists('donasis');
    }
};
