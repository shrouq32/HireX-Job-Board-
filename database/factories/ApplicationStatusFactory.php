<?php

namespace Database\Factories;

use App\Models\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationStatusFactory extends Factory
{
    protected $model = ApplicationStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement(['pending', 'rejected', 'accepted']),
        ];
    }
}
