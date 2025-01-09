<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Semester;
use App\Models\TahunPelajaran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
        ]);
        TahunPelajaran::create([
            'nama' => '2024/2025',
            'status' => 'Aktif',
        ]);
        TahunPelajaran::create([
            'nama' => '2025/2026',
            'status' => 'Nonaktif',
        ]);
        Semester::create([
            'nama' => 'Ganjil',
            'status' => 'Aktif',
        ]);
        Semester::create([
            'nama' => 'Genap',
            'status' => 'Nonaktif',
        ]);
    }
}
