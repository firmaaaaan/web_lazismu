<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    use HasFactory;
    protected $table='penyaluran';
    protected $guarded=['id'];

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'id_mustahik');
    }
}