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
        Schema::create('program_donasis', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nama_program');
            $table->string('no_rek');
            $table->unsignedBigInteger('jumlah_donasi_program')->default(0);
            $table->integer('distribution_amount')->default(0);
            $table->text('deskripsi');
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
        Schema::dropIfExists('program_donasis');
    }
};
