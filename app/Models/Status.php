<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table ='status';
    protected $guarded=['id'];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }
    public function zakat(){
        return $this->hasMany(Zakat::class);
    }
    public function permintaanAmbulan(){
        return $this->hasMany(Zakat::class);
    }
}