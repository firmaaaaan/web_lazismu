<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'nama_status' => 'Diproses',
        ]);
        DB::table('status')->insert([
            'nama_status' => 'Tervalidasi',
        ]);
        DB::table('status')->insert([
            'nama_status' => 'Baru',
        ]);
        DB::table('status')->insert([
            'nama_status' => 'Diterima',
        ]);
        DB::table('status')->insert([
            'nama_status' => 'Ditolak',
        ]);
    }
}