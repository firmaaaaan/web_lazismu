<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table ='rumah_sakits';
    protected $guarded =['id'];

    public function permintaanAmbulan(){
        return $this->hasMany(permintaanAmbulan::class);
    }
}