<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama', 'no_hp', 'email', 'alamat'];

    // relasi table dari boking
    public function boking(){
        return $this->hasMany(Boking::class);
    }
}
