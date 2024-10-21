<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $table = 'mobil';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function jenis_mobil(){
        return $this->belongsTo(Jenismobil::class, 'id_jenis','id');
    }
    public function merk_mobil(){
        return $this->belongsTo(Merkmobil::class, 'id_merk','id');
    }
    public function penyewaan(){
        return $this->hasMany(Penyewaan::class, 'id_mobil');
    }
}
