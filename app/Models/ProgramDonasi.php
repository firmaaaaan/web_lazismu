<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramDonasi extends Model
{
    use HasFactory;

    protected $table ='program_donasis';
    protected $guarded =['id'];

        public function user(){
        return $this->hasMany(User::class, 'user_id');
    }
    public function donasi(){
        return $this->hasMany(Donasi::class);
    }
}