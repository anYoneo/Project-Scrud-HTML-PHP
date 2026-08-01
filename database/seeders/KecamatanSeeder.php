<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatans = [
            'Maja', 'Majalengka', 'Cigasong', 'Panyingkiran',
            'Kadipaten', 'Kasokandel', 'Dawuan', 'Palasah',
            'Jatiwangi', 'Ligung', 'Sumberjaya', 'Sindangwangi',
            'Leuwimunding', 'Sukahaji', 'Rajagaluh', 'Sindang',
            'Cingambul', 'Talaga', 'Banjaran', 'Argapura',
            'Lemahsugih', 'Malausma', 'Cikijing', 'Bantarujeg',
            'Cikalong', 'Pagerageung',
        ];

        foreach ($kecamatans as $nama) {
            Kecamatan::create(['nama_kecamatan' => $nama]);
        }
    }
}
