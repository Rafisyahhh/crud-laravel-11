<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function mobil(){
        return $this->belongsTo(Mobil::class, 'id_mobil','id');
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id');
    }
    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'id_karyawan','id');
    }
    public function pengembalian(){
        return $this->hasMany(Pengembalian::class, 'id_penyewaan');
    }
}
