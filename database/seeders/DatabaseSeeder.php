<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. DATA JURUSAN ---
        $ti = Jurusan::create(['nama_jurusan' => 'Teknik Informatika']);
        $si = Jurusan::create(['nama_jurusan' => 'Sistem Informasi']);
        $bd = Jurusan::create(['nama_jurusan' => 'Bisnis Digital']);

        // --- 2. DATA USER (ADMIN & USER UMUM) ---
        User::create([
            'name' => 'Administrator Utama',
            'username' => 'admin123',
            'password' => 'admin123',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Budi User Umum',
            'username' => 'budi123',
            'password' => 'budi123',
            'role' => 'user'
        ]);

        // --- 3. DATA MAHASISWA (Tes Login) ---
        $this->buatMahasiswa('23552011373', 'Ikmal Mahasiswa', $ti->id_jurusan, 'password123');
        $this->buatMahasiswa('23552011001', 'Siti Aminah', $si->id_jurusan, 'password123');
        $this->buatMahasiswa('23552011002', 'Joko Susilo', $bd->id_jurusan, 'password123');

        // --- 4. DATA MATA KULIAH ---

        // Mata Kuliah TEKNIK INFORMATIKA (TI)
        $matkulTI = [
            ['nama' => 'Pemrograman Web 2', 'sks' => 3],
            ['nama' => 'Pemrograman Mobile (Flutter)', 'sks' => 3],
            ['nama' => 'Kecerdasan Buatan', 'sks' => 2],
            ['nama' => 'Jaringan Komputer', 'sks' => 3],
            ['nama' => 'Sistem Operasi', 'sks' => 2],
            ['nama' => 'Struktur Data & Algoritma', 'sks' => 4],
        ];
        foreach($matkulTI as $m) {
            Matakuliah::create(['nama_matakuliah' => $m['nama'], 'sks' => $m['sks'], 'id_jurusan' => $ti->id_jurusan]);
        }

        // Mata Kuliah SISTEM INFORMASI (SI)
        $matkulSI = [
            ['nama' => 'Analisis Perancangan Sistem', 'sks' => 3],
            ['nama' => 'Manajemen Proyek TI', 'sks' => 2],
            ['nama' => 'Enterprise Resource Planning (ERP)', 'sks' => 3],
            ['nama' => 'E-Commerce', 'sks' => 2],
            ['nama' => 'Tata Kelola TI', 'sks' => 3],
        ];
        foreach($matkulSI as $m) {
            Matakuliah::create(['nama_matakuliah' => $m['nama'], 'sks' => $m['sks'], 'id_jurusan' => $si->id_jurusan]);
        }

        // Mata Kuliah BISNIS DIGITAL (BD)
        $matkulBD = [
            ['nama' => 'Digital Marketing Strategy', 'sks' => 3],
            ['nama' => 'Financial Technology', 'sks' => 2],
            ['nama' => 'Big Data Analytics for Business', 'sks' => 3],
            ['nama' => 'Kewirausahaan Digital', 'sks' => 3],
            ['nama' => 'Hukum Bisnis Digital', 'sks' => 2],
        ];
        foreach($matkulBD as $m) {
            Matakuliah::create(['nama_matakuliah' => $m['nama'], 'sks' => $m['sks'], 'id_jurusan' => $bd->id_jurusan]);
        }
    }

    // Fungsi pembantu agar kode lebih rapi
    private function buatMahasiswa($nim, $nama, $id_jurusan, $pass) {
        User::create([
            'name' => $nama,
            'username' => $nim,
            'password' => $pass,
            'role' => 'mahasiswa'
        ]);

        Mahasiswa::create([
            'nim' => $nim,
            'nama' => $nama,
            'id_jurusan' => $id_jurusan,
            'password' => $pass,
            'role' => 'mahasiswa'
        ]);
    }
}