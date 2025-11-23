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
        Schema::create('departements', function (Blueprint $table) {
            $table->id();
            // Kita gunakan enum sesuai request Anda
            $table->enum('nama', [
                'Pengembangan Sumber Daya Manusia',
                'Informasi dan Komunikasi',
                'Advokasi dan Kesejahteraan Mahasiswa',
                'Sosial Masyarakat',
                'Pengembangan Riset dan Teknologi',
                'Kesejahteraan Rumah Tangga',
                'Pemberdayaan Aparatur Organisasi'
            ]);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};
