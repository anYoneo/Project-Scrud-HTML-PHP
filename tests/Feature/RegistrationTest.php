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
        Jurusan::create([
            'nama_jurusan' => 'Teknik Komputer',
            'kuota' => 40,
            'is_active' => true,
        ]);
    }

    public function test_registration_page_loads(): void
    {
        $response = $this->get(route('registration.create'));
        $response->assertStatus(200);
        $response->assertSee('Teknik Komputer');
    }

    public function test_student_can_register(): void
    {
        $response = $this->post(route('registration.store'), [
            'jurusan_id' => 1,
            'nama_peserta' => 'Budi Santoso',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2010-05-15',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat' => 'Jl. Merdeka No. 10',
            'nama_wali' => 'Andi Santoso',
            'telepon_wali' => '08123456789',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pendaftaran', [
            'nama_peserta' => 'Budi Santoso',
            'status' => 'pending',
        ]);
    }

    public function test_registration_validates_required_fields(): void
    {
        $response = $this->post(route('registration.store'), []);
        $response->assertSessionHasErrors([
            'nama_peserta', 'tempat_lahir', 'tanggal_lahir',
            'jenis_kelamin', 'agama', 'alamat', 'nama_wali', 'telepon_wali',
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
            'jurusan_id' => 1,
            'status' => 'pending',
        ]);

        $response = $this->get(route('registration.status', $pendaftaran->nomor_pendaftaran));
        $response->assertStatus(200);
        $response->assertSee('pending');
    }
}