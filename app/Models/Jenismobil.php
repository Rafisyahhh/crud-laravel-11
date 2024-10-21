<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenismobil extends Model
{
    use HasFactory;
    protected $table = 'jenis_mobil';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function mobil(){
        return $this->hasMany(Mobil::class, 'id_jenis');
    }
}
