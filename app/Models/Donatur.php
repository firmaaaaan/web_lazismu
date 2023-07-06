<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $table='donaturs';
    protected $guarded=['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_donatur');
    }
}