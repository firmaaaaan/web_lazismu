<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $table='mustahiks';
    protected $guarded =['id'];

    public function penyaluran()
    {
        return $this->hasMany(Penyaluran::class, 'id_mustahik');
    }
}