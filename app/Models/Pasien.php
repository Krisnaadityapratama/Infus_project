<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Pasien extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'alat',
        'nama',
        'ruang',
        'tetes', // Tambahkan tetes ke atribut yang bisa diisi
        'status'
    ];

    public function sensor(){
        return $this->hasMany(sensor::class,'id','alat');
    }   

    public function Value(){
        return $this->belongsTo(Value::class,'id','alat');
    }   
}
