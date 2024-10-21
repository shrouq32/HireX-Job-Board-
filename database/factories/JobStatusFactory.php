<?php

namespace Database\Factories;

use App\Models\JobStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobStatusFactory extends Factory
{
    protected $model = JobStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['pending', 'rejected', 'accepted']),
        ];
    }
}
