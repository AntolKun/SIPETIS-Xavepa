<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Siswa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'nisn' => '0001',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'nama' => 'Admin Utama',
        ]);

        $muridUser = User::create([
            'nisn' => '1234',
            'password' => bcrypt('muridpass'),
            'role' => 'murid',
        ]);

        Siswa::create([
            'user_id' => $muridUser->id,
            'nama' => 'Kepin',
            'kelas' => '9A',
            'status_bayar' => 'sudah',
        ]);
    }
}
