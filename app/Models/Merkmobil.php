<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merkmobil extends Model
{
    use HasFactory;
    protected $table = 'merk_mobil';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public function mobil(){
        return $this->hasMany(Mobil::class, 'id_merk');
    }
}
