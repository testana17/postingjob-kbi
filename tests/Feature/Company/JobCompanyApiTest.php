<?php

namespace Tests\Feature\Api\Company;

use Tests\TestCase;
use App\Models\User;
use App\Models\JobUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class JobCompanyApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;
    private $jobData;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user with company role
        $this->user = User::factory()->create([
            'role' => 'company'
        ]);

        // Sample job data
        $this->jobData = [
            'judul' => $this->faker->jobTitle,
            'deskripsi' => $this->faker->paragraph,
            'gaji' => $this->faker->randomFloat(2, 1000, 10000),
            'kategori' => $this->faker->word,
            'type' => $this->faker->randomElement(['Remote', 'FullTime', 'Parttime', 'Contract']),
            'lokasi' => $this->faker->city,
        ];
    }

    /** @test */
    public function unauthorized_users_cannot_access_endpoints()
    {
        $response = $this->getJson('/api/jobs');
        $response->assertStatus(401);

        $response = $this->postJson('/api/jobs', $this->jobData);
        $response->assertStatus(401);
    }

    /** @test */
    public function non_company_users_cannot_access_endpoints()
    {
        $regularUser = User::factory()->create([
            'role' => 'user'
        ]);

        $response = $this->actingAs($regularUser)
            ->getJson('/api/jobs');
        $response->assertStatus(403);
    }

    /** @test */
    public function company_can_get_all_jobs()
    {
        JobUser::factory()->count(3)->create([
            'users_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/jobs');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function company_can_create_job()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/jobs', $this->jobData);

        $response->assertStatus(201)
            ->assertJson([
                'judul' => $this->jobData['judul'],
                'deskripsi' => $this->jobData['deskripsi'],
                'gaji' => $this->jobData['gaji'],
                'kategori' => $this->jobData['kategori'],
                'type' => $this->jobData['type'],
                'lokasi' => $this->jobData['lokasi'],
            ]);

        $this->assertDatabaseHas('job_users', [
            'judul' => $this->jobData['judul'],
            'users_id' => $this->user->id
        ]);
    }

    /** @test */
    // public function company_can_view_specific_job()
    // {
    //     $job = JobUser::factory()->create([
    //         'users_id' => $this->user->id
    //     ]);

    //     $response = $this->actingAs($this->user)
    //         ->getJson("/api/jobs/{$job->id}");

    //     $response->assertStatus(200)
    //         ->assertJson([
    //             'id' => $job->id,
    //             'judul' => $job->judul
    //         ]);
    // }

    /** @test */
    public function company_can_update_job()
    {
        $job = JobUser::factory()->create([
            'users_id' => $this->user->id
        ]);

        $updatedData = [
            'judul' => 'Updated Job Title',
            'deskripsi' => 'Updated description',
            'gaji' => 5000.00,
            'kategori' => 'IT',
            'type' => 'Remote',
            'lokasi' => 'Jakarta'
        ];

        $response = $this->actingAs($this->user)
            ->putJson("/api/jobs/{$job->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);

        $this->assertDatabaseHas('job_users', [
            'id' => $job->id,
            'judul' => 'Updated Job Title'
        ]);
    }

    /** @test */
    public function company_can_delete_job()
    {
        $job = JobUser ::factory()->create([
            'users_id' => $this->user->id
        ]);
    
        // Log the job ID for debugging
        \Log::info('Job ID to delete: ' . $job->id);
    
        $response = $this->actingAs($this->user)
            ->deleteJson("/api/jobs/{$job->id}");
    
        $response->assertStatus(204);
        $this->assertDatabaseMissing('job_users', ['id' => $job->id]);
    }

    /** @test */
    public function validation_errors_return_400()
    {
        $invalidData = [
            'judul' => '', // Required field is empty
            'gaji' => 'not-a-number', // Invalid format
            'type' => 'InvalidType' // Not in enum
        ];

        $response = $this->actingAs($this->user)
            ->postJson('/api/jobs', $invalidData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['judul', 'gaji', 'type']);
    }
}