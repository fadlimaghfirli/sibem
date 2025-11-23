<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabinet; // PENTING

class CabinetSeeder extends Seeder
{
    public function run(): void
    {
        // Kabinet Lama (Tidak Aktif)
        Cabinet::create([
            'nama_kabinet' => 'Kabinet Perintis',
            'tahun_periode' => '2023/2024',
            'is_active' => false,
        ]);

        // Kabinet Sekarang (Aktif)
        Cabinet::create([
            'nama_kabinet' => 'Kabinet Sinergi',
            'tahun_periode' => '2024/2025',
            'is_active' => true,
        ]);
    }
}
