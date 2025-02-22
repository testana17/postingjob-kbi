<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\JobUser;
use App\Models\Application;

class ApplicationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $job;
    private $application;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user dengan role user
        $this->user = User::factory()->create([
            'role' => 'user',
        ]);

        // Buat job yang akan dilamar
        $this->job = JobUser::factory()->create();

        // Buat aplikasi pekerjaan yang sudah diajukan user
        $this->application = Application::factory()->create([
            'user_id' => $this->user->id,
            'job_id' => $this->job->id,
            'cv_path' => 'path/to/cv.pdf',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_can_get_all_jobs()
    {
        // Authenticate the user
        $this->actingAs($this->user, 'sanctum');

        // Buat beberapa job tambahan menggunakan factory
        JobUser::factory()->count(5)->create();

        // Panggil endpoint untuk mendapatkan daftar pekerjaan
        $response = $this->getJson('/api/jobslist');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'title', 'description', 'created_at', 'updated_at']
                     ]
                 ])
                 ->assertJsonCount(6, 'data'); // 1 dari setUp + 5 baru = 6 total
    }

    /** @test */
    public function it_can_apply_for_a_job()
    {
        // Authenticate user dan apply pekerjaan
        $response = $this->actingAs($this->user, 'sanctum')->postJson("/api/jobs/{$this->job->id}/apply", [
            'cv_path' => 'path/to/new_cv.pdf',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Job Applied successfully.']);

        // Pastikan aplikasi masuk ke database
        $this->assertDatabaseHas('applications', [
            'user_id' => $this->user->id,
            'job_id' => $this->job->id,
            'cv_path' => 'path/to/new_cv.pdf',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_can_get_applied_jobs()
    {
        // Authenticate user
        $this->actingAs($this->user, 'sanctum');

        // Panggil endpoint untuk melihat daftar pekerjaan yang sudah dilamar
        $response = $this->getJson('/api/my-applied-jobs');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'user_id', 'job_id', 'cv_path', 'status', 'created_at', 'updated_at']
                     ]
                 ])
                 ->assertJsonCount(1, 'data'); // Hanya 1 aplikasi yang dibuat di setUp
    }
}
