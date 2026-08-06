<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            ['nama_jurusan' => 'Teknik Komputer dan Jaringan', 'kuota' => 100],
            ['nama_jurusan' => 'Teknik Otomotif', 'kuota' => 80],
            ['nama_jurusan' => 'Teknik Las', 'kuota' => 50],
            ['nama_jurusan' => 'Akuntansi', 'kuota' => 120],
            ['nama_jurusan' => 'Administrasi Perkantoran', 'kuota' => 120],
        ];

        foreach ($jurusans as $j) {
            Jurusan::create([
                'nama_jurusan' => $j['nama_jurusan'],
                'kuota' => $j['kuota'],
                'is_active' => true
            ]);
        }
    }
}
