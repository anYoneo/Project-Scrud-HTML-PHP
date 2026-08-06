<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::create([
            'name' => 'Test Admin',
            'username' => 'admin',
            'password' => 'password',
        ]);
        Jurusan::create(['nama_jurusan' => 'TKJ', 'kuota' => 40]);
    }

    public function test_admin_can_login(): void
    {
        $response = $this->post(route('login'), [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->admin, 'admin');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_login_with_wrong_password(): void
    {
        $response = $this->post(route('login'), [
            'username' => 'admin',
            'password' => 'wrong',
        ]);

        $this->assertGuest('admin');
    }

    public function test_login_is_rate_limited(): void
    {
        for ($i = 0; $i < 6; $i++) {
            $this->post(route('login'), [
                'username' => 'admin',
                'password' => 'wrong',
            ]);
        }

        $response = $this->post(route('login'), [
            'username' => 'admin',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('username');
    }

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_registration_status(): void
    {
        \App\Models\Kecamatan::create(['nama_kecamatan' => 'Leuwimunding']);
        $pendaftaran = Pendaftaran::factory()->create(['jurusan' => 'TKJ']);

        $response = $this->actingAs($this->admin, 'admin')
            ->patch(route('admin.pendaftaran.updateStatus', $pendaftaran), [
                'status' => 'accepted',
                'catatan_admin' => 'Memenuhi syarat',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pendaftarans', [
            'id' => $pendaftaran->id,
            'status' => 'diterima',
        ]);
    }

    public function test_unauthenticated_cannot_access_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }
}
