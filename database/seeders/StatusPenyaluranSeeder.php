<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusPenyaluranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_penyaluran')->insert([
            'nama_status' => 'Belum Tersalurkan',
        ]);
        DB::table('status_penyaluran')->insert([
            'nama_status' => 'Tersalurkan',
        ]);
    }
}