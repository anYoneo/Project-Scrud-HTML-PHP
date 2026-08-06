<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendaftaran>
 */
class PendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_pendaftaran' => \App\Models\Pendaftaran::generateNomor(),
            'tanggal_daftar' => \Illuminate\Support\Carbon::today(),
            'tahun_ajaran' => date('Y') . '/' . (date('Y') + 1),
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'nama_peserta' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-15 years'),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'agama' => 'Islam',
            'alamat' => $this->faker->address,
            'kecamatan_id' => function() {
                return \App\Models\Kecamatan::first()->id ?? \App\Models\Kecamatan::create(['nama_kecamatan' => 'Leuwimunding'])->id;
            },
            'telepon' => $this->faker->phoneNumber,
            'status' => 'pending',
        ];
    }
}
