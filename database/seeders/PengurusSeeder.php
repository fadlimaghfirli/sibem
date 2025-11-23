<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengurus;
use App\Models\Cabinet;
use App\Models\Departement;

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data pendukung
        $kabinetAktif = Cabinet::where('is_active', true)->first();
        $deptKominfo = Departement::where('nama', 'Informasi dan Komunikasi')->first();
        $deptPSDM = Departement::where('nama', 'Pengembangan Sumber Daya Manusia')->first();

        // 1. Contoh Gubernur (Tanpa Departemen)
        Pengurus::create([
            'cabinet_id' => $kabinetAktif->id,
            'departement_id' => null, // Gubernur tidak punya departemen spesifik
            'nama' => 'Budi Santoso',
            'nim' => '12345678',
            'angkatan' => 2021,
            'prodi' => 'Pendidikan Informatika',
            'jabatan' => 'Gubernur',
            'foto' => null,
        ]);

        // 2. Contoh Staff Kominfo
        Pengurus::create([
            'cabinet_id' => $kabinetAktif->id,
            'departement_id' => $deptKominfo->id,
            'nama' => 'Siti Aminah',
            'nim' => '87654321',
            'angkatan' => 2022,
            'prodi' => 'Pendidikan Guru Sekolah Dasar', // Sesuai Enum
            'jabatan' => 'Staff Departemen',
            'foto' => null,
        ]);

        // 3. Contoh Kepala Dept PSDM
        Pengurus::create([
            'cabinet_id' => $kabinetAktif->id,
            'departement_id' => $deptPSDM->id,
            'nama' => 'Rudi Hartono',
            'nim' => '11223344',
            'angkatan' => 2021,
            'prodi' => 'Pendidikan Bahasa dan Sastra Indonesia',
            'jabatan' => 'Kepala Departemen',
            'foto' => null,
        ]);
    }
}
