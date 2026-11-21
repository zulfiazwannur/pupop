<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_tamu_diarahkan_ke_halaman_masuk(): void
    {
        $this->get('/home')->assertRedirect('/masuk');
        $this->get('/role')->assertRedirect('/masuk');
        $this->get('/setor')->assertRedirect('/masuk');
    }

    public function test_password_disimpan_dalam_bentuk_hash(): void
    {
        $this->post('/daftar', [
            'name' => 'Budi',
            'email' => 'budi@example.com',
            'password' => 'rahasia123',
            'terms' => 'on',
        ])->assertRedirect('/masuk');

        $user = User::where('email', 'budi@example.com')->firstOrFail();
        $this->assertNotSame('rahasia123', $user->password);
        $this->assertTrue(password_verify('rahasia123', $user->password));
    }

    public function test_email_duplikat_dan_password_pendek_ditolak(): void
    {
        User::factory()->create(['email' => 'ada@example.com']);

        $this->post('/daftar', [
            'name' => 'Dua', 'email' => 'ada@example.com',
            'password' => 'rahasia123', 'terms' => 'on',
        ])->assertSessionHasErrors('email');

        $this->post('/daftar', [
            'name' => 'Tiga', 'email' => 'baru@example.com',
            'password' => 'pendek', 'terms' => 'on',
        ])->assertSessionHasErrors('password');
    }

    public function test_login_berhasil_dan_gagal(): void
    {
        User::factory()->create(['email' => 'login@example.com', 'password' => 'rahasia123']);

        $this->post('/masuk', ['email' => 'login@example.com', 'password' => 'salah'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->post('/masuk', ['email' => 'login@example.com', 'password' => 'rahasia123'])
            ->assertRedirect('/role');
        $this->assertAuthenticated();
    }

    public function test_logout_hanya_lewat_post(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/keluar')->assertStatus(405);
        $this->actingAs($user)->post('/keluar')->assertRedirect('/masuk');
        $this->assertGuest();
    }

    public function test_upload_foto_valid_diterima(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/profil/foto', ['foto' => UploadedFile::fake()->image('foto.png')])
            ->assertSessionHasNoErrors();

        Storage::disk('public')->assertExists($user->fresh()->foto_profil);
    }

    public function test_upload_file_bukan_gambar_ditolak(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/profil/foto', [
                'foto' => UploadedFile::fake()->create('shell.php', 10, 'application/x-php'),
            ])
            ->assertSessionHasErrors('foto');

        $this->assertNull($user->fresh()->foto_profil);
    }
}
