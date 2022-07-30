<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boking extends Model
{
    use HasFactory;
    protected $table = 'bokings';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'member_id', 'paket_id', 'duration','tanggal',];

    // relasi table dari member dengan member_id(foreign_key)
    public function member()
    {
        return $this->belongsTo(member::class,'member_id');
    }

    // relasi table dari paket dengan paket_id(foreign_key)
    public function paket()
    {
        return $this->belongsTo(paket::class, 'paket_id');
    }
}
