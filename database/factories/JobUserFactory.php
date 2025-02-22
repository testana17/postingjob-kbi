<?php

namespace Database\Factories;

use App\Models\JobUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'users_id' => User::factory(),
            'judul' => $this->faker->jobTitle(),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'gaji' => $this->faker->randomFloat(2, 3000000, 20000000),
            'kategori' => $this->faker->randomElement([
                'IT & Software',
                'Design & Creative',
                'Sales & Marketing',
                'Writing & Translation',
                'Admin & Support',
                'Customer Service',
                'Finance & Accounting',
                'Engineering & Architecture',
                'HR & Legal',
                'Healthcare & Medicine'
            ]),
            'type' => $this->faker->randomElement(['Remote', 'FullTime', 'Parttime', 'Contract']),
            'lokasi' => $this->faker->city() . ', ' . $this->faker->country(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the job is remote.
     */
    public function remote(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Remote',
                'lokasi' => 'Remote'
            ];
        });
    }

    /**
     * Indicate that the job is full time.
     */
    public function fullTime(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'FullTime'
            ];
        });
    }

    /**
     * Indicate that the job is part time.
     */
    public function partTime(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Parttime'
            ];
        });
    }

    /**
     * Indicate that the job is contract based.
     */
    public function contract(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Contract'
            ];
        });
    }

    /**
     * Set a specific salary range.
     */
    public function salary(float $min, float $max): self
    {
        return $this->state(function (array $attributes) use ($min, $max) {
            return [
                'gaji' => $this->faker->randomFloat(2, $min, $max)
            ];
        });
    }
}