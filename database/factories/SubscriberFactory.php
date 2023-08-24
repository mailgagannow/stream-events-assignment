<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
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
                'subscription_tier' => $this->faker->numberBetween(1, 3),
                'created_at' => $created_at,
                'updated_at' => $created_at
            ];
  
    }
}
