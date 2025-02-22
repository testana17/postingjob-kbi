<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user dengan role "company"
        $this->user = User::factory()->create([
            'role' => 'company',
            'password' => bcrypt('password'),
        ]);
    }

    /**
     * Test registrasi user baru
     */
    public function test_it_can_register_a_user()
    {
        $response = $this->postJson('/api/register', [
            'id' => (string) Str::uuid(), // UUID
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'User registered successfully']);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'user',
        ]);
    }

    /**
     * Test login user dengan kredensial yang benar
     */
    public function test_it_can_login_a_user()
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'user']);
    }

    /**
     * Test login gagal dengan password salah
     */
    public function test_it_fails_to_login_with_wrong_password()
    {
        $response = $this->postJson('/api/login', [
            'email' => $this->user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Invalid credentials']);
    }

    /**
     * Test logout user dengan menghapus token
     */
    public function test_user_can_logout()
    {
        $this->actingAs($this->user, 'web');

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Logged out successfully']);
    }

    /**
     * Test akses ke endpoint yang butuh autentikasi tanpa token
     */
    public function test_protected_route_requires_authentication()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
    }

    /**
     * Test akses ke endpoint yang butuh autentikasi dengan token
     */
    public function test_authenticated_user_can_access_protected_route()
    {
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->user->id,
                'email' => $this->user->email,
            ]);
    }
}
