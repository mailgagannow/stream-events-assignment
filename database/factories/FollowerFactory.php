<?php

namespace Database\Factories;

use App\Models\Follower;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-3 months', 'now');

    return [
        'name' => $this->faker->name(),
        'created_at' => $created_at,
        'updated_at' => $created_at
    ];
    }
}
