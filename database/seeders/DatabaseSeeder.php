<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User Login Admin (Untuk Anda login nanti)
        \App\Models\User::factory()->create([
            'name' => 'Admin BEM',
            'email' => 'admin@bemfkip.ac.id',
            'password' => bcrypt('admin123'), // Passwordnya: admin123
        ]);

        // Panggil seeder yang kita buat tadi
        $this->call([
            DepartementSeeder::class,
            CabinetSeeder::class,
            PengurusSeeder::class,
        ]);
    }
}
