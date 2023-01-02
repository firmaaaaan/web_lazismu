<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPenyaluran extends Model
{
    use HasFactory;
    protected $table ='status_penyaluran';
    protected $guarded=['id'];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }
}