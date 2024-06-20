<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'status'
        ];

       
        public function Pasien(){
            return $this->belongsTo(Pasien::class);
        }
        public function Value(){
            return $this->hasMany(Value::class,'id');
        }   
}
