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
        Schema::create('penguruses', function (Blueprint $table) {
            $table->id();

            // Relasi: Pengurus milik Kabinet apa & Departemen apa
            $table->foreignId('cabinet_id')->constrained('cabinets')->onDelete('cascade');
            // Departemen boleh null (karena Gubernur tidak masuk departemen tertentu)
            $table->foreignId('departement_id')->nullable()->constrained('departements')->onDelete('set null');

            // Data Diri
            $table->string('nama');
            $table->string('nim');
            $table->integer('angkatan');
            $table->string('foto')->nullable(); // Path foto

            // Enum Prodi (Sesuai Request)
            $table->enum('prodi', [
                'Pendidikan Informatika', // Saya perbaiki singkatan PIF jadi nama lengkap agar rapi, atau mau singkatan?
                'Pendidikan Ilmu Pengetahuan Alam',
                'Pendidikan Bahasa dan Sastra Indonesia',
                'Pendidikan Guru Sekolah Dasar',
                'Pendidikan Anak Usia Dini'
            ]);

            // Enum Jabatan (Sesuai Request)
            $table->enum('jabatan', [
                'Gubernur',
                'Wakil Gubernur',
                'Sekretaris Jenderal',
                'Sekretaris Umum',
                'Bendahara Umum',
                'Kepala Departemen',
                'Sekretaris Departemen',
                'Anggota Departemen',
                'Staff Departemen'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penguruses');
    }
};
