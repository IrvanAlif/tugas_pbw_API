<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $mhs = \App\Models\Mahasiswa::create([
            'nim' => '2021001001',
            'nama' => 'Budi Santoso',
            'prodi' => 'Teknik Informatika',
            'angkatan' => '2021',
            'email' => 'budi@student.ac.id'
        ]);

        \App\Models\Nilai::create([
            'mahasiswa_id' => $mhs->id,
            'mata_kuliah' => 'Pemrograman Web',
            'kode_mk' => 'IF2201',
            'nilai_angka' => 88.5,
            'nilai_huruf' => 'A',
            'sks' => 3,
            'semester' => 'Ganjil 2023'
        ]);

        \App\Models\Nilai::create([
            'mahasiswa_id' => $mhs->id,
            'mata_kuliah' => 'Basis Data',
            'kode_mk' => 'IF2102',
            'nilai_angka' => 75.0,
            'nilai_huruf' => 'B',
            'sks' => 3,
            'semester' => 'Ganjil 2023'
        ]);
    }
}
