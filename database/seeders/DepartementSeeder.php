<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Pengembangan Sumber Daya Manusia',
            'Informasi dan Komunikasi',
            'Advokasi dan Kesejahteraan Mahasiswa',
            'Sosial Masyarakat',
            'Pengembangan Riset dan Teknologi',
            'Kesejahteraan Rumah Tangga',
            'Pemberdayaan Aparatur Organisasi',
        ];

        foreach ($data as $namaDept) {
            Departement::create([
                'nama' => $namaDept,
                'deskripsi' => 'Deskripsi tugas untuk ' . $namaDept,
            ]);
        }
    }
}
