<?php

namespace Tests\Feature\Company;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Application;
use App\Models\JobUser;

class UserAppTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $job;
    private $application;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user with company role
        $this->user = User::factory()->create([
            'role' => 'company'
        ]);

        // Create a job for the user
        $this->job = JobUser::factory()->create([
            'users_id' => $this->user->id
        ]);

        // Create an application for the job
        $this->application = Application::factory()->create([
            'user_id' => $this->user->id,
            'job_id' => $this->job->id,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_can_list_applications()
    {
        $response = $this->actingAs($this->user)->getJson('/api/applications');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'data' => [
                             '*' => ['id', 'user_id', 'job_id', 'status', 'created_at', 'updated_at']
                         ]
                     ]
                 ]);
    }

    /** @test */
    public function it_can_update_application_status()
    {
        $response = $this->actingAs($this->user)
            ->putJson("/api/applications/{$this->application->id}", [
                'status' => 'accepted'
            ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Status berhasil diperbarui',
                     'data' => [
                         'id' => $this->application->id,
                         'status' => 'accepted',
                     ]
                 ]);

        $this->assertDatabaseHas('applications', [
            'id' => $this->application->id,
            'status' => 'accepted',
        ]);
    }

    /** @test */
    public function it_fails_when_updating_with_invalid_status()
    {
        $response = $this->actingAs($this->user)
            ->putJson("/api/applications/{$this->application->id}", [
                'status' => 'invalid_status'
            ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['status']);
    }
}
