<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table ='donasis';
    protected $guarded=['id'];

    protected $attributes = [
    'status_penyaluran' => 'Belum Tersalurkan'
    ];


    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function statusPenyaluran(){
        return $this->belongsTo(StatusPenyaluran::class);
    }

    public function programDonasi(){
        return $this->belongsTo(ProgramDonasi::class,'programdonasi_id');
    }
    public function akun(){
        return $this->belongsTo(Akun::class,'id_akun');
    }
}