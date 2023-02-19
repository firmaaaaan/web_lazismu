<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table="akuns";
    protected $guarded=['id'];

    public function programDonasi(){
        return $this->belongsTo(ProgramDonasi::class);
    }
    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_akun', 'id');
    }
}