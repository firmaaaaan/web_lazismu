<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTransaksi extends Model
{
    use HasFactory;
    protected $table="log_transaksis";
    protected $guard=['id'];

    public function programdonasi()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_programdonasi_asal');
    }
    public function programdonasi_tujuan()
    {
        return $this->belongsTo(ProgramDonasi::class, 'id_programdonasi_tujuan');
    }
}