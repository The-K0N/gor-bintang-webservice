<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'paket', 'fasilitas', 'harga', 'keterangan'];
   
    // // relasi table dari boking
    public function boking()
    {
        return $this->hasMany(boking::class);
    }

}
