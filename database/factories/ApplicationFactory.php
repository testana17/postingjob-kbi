<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\JobUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => User::factory(),
            'job_id' => JobUser::factory(),
            'cv_path' => 'cv/' . $this->faker->uuid() . '.pdf', // Simulasi path CV
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
