<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();        
            $table->integer('durasi_sewa');                          
            $table->date('tgl_sewa');                          
            $table->integer('total_harga');
            $table->foreignId('id_pelanggan')->constrained('pelanggan');
            $table->foreignId('id_karyawan')->constrained('karyawan');               
            $table->foreignId('id_mobil')->constrained('mobil');               
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
