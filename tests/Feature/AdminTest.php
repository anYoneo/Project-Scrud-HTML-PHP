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
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
        Jurusan::create(['nama_jurusan' => 'TKJ', 'kuota' => 40]);
    }

    public function test_admin_can_login(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@test.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->admin, 'admin');
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_login_with_wrong_password(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'admin@test.com',
            'password' => 'wrong',
        ]);

        $this->assertGuest('admin');
    }

    public function test_login_is_rate_limited(): void
    {
        for ($i = 0; $i < 6; $i++) {
            $this->post(route('login'), [
                'email' => 'admin@test.com',
                'password' => 'wrong',
            ]);
        }

        $response = $this->post(route('login'), [
            'email' => 'admin@test.com',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_registration_status(): void
    {
        $pendaftaran = Pendaftaran::factory()->create(['jurusan_id' => 1]);

        $response = $this->actingAs($this->admin, 'admin')
            ->patch(route('admin.pendaftaran.updateStatus', $pendaftaran), [
                'status' => 'accepted',
                'catatan_admin' => 'Memenuhi syarat',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pendaftaran', [
            'id' => $pendaftaran->id,
            'status' => 'accepted',
        ]);
        $this->assertDatabaseHas('audit_logs', [
            'action' => 'update_status',
            'entity_type' => 'pendaftaran',
            'entity_id' => $pendaftaran->id,
        ]);
    }

    public function test_unauthenticated_cannot_access_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }
}