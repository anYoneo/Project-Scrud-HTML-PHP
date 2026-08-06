<?php

namespace Tests\Feature;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        \App\Models\Kecamatan::create(['nama_kecamatan' => 'Leuwimunding']);
        Jurusan::create([
            'nama_jurusan' => 'Teknik Komputer dan Jaringan',
            'kuota' => 40,
            'is_active' => true,
        ]);
    }

    public function test_registration_page_loads(): void
    {
        $response = $this->get(route('registration.create'));
        $response->assertStatus(200);
        $response->assertSee('Teknik Komputer dan Jaringan');
    }

    public function test_student_can_register(): void
    {
        $kecamatan = \App\Models\Kecamatan::first();

        $response = $this->post(route('registration.store'), [
            'jurusan_id' => 'Teknik Komputer dan Jaringan',
            'nama_peserta' => 'Budi Santoso',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1999-05-15',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'alamat' => 'Jl. Merdeka No. 10',
            'telepon' => '08123456789',
            'kecamatan_id' => $kecamatan->id,
        ]);

        if ($response->status() !== 302) {
            fwrite(STDERR, print_r(session()->get('errors') ? session()->get('errors')->all() : 'No validation errors', true));
        }

        $response->assertRedirect(route('registration.success', 'P' . date('Y') . '00001'));
        $this->assertDatabaseHas('pendaftarans', [
            'nama_peserta' => 'Budi Santoso',
            'status' => 'pending',
            'telepon' => '08123456789',
        ]);
    }

    public function test_registration_validates_required_fields(): void
    {
        $response = $this->post(route('registration.store'), []);
        $response->assertSessionHasErrors([
            'nama_peserta', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'agama', 'alamat', 'kecamatan_id', 'jurusan_id',
        ]);
    }

    public function test_registration_generates_unique_number(): void
    {
        $number1 = Pendaftaran::generateNomorPendaftaran();
        $this->assertEquals('P' . date('Y') . '00001', $number1);
    }

    public function test_student_can_check_status(): void
    {
        $pendaftaran = Pendaftaran::factory()->create([
            'jurusan' => 'Teknik Komputer dan Jaringan',
            'status' => 'pending',
        ]);

        $response = $this->get(route('registration.status', $pendaftaran->nomor_pendaftaran));
        $response->assertStatus(200);
        $response->assertSee('pending');
    }
}
