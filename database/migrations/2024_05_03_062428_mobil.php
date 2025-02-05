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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id();        
            $table->integer('tahun');               
            $table->string('no_plat');               
            $table->integer('harga_sewa');
            $table->foreignId('id_merk')->constrained('merk_mobil');
            $table->foreignId('id_jenis')->constrained('jenis_mobil');               
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
