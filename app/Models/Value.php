<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'idPasien',
        'alat',
        'tpm',
        'kapasitas',
        'prediksi',
        'status',
    
        ];
    

        public function Pasien(){
            return $this->belongsTo(Pasien::class,'id','idPasien');
        }   
}
