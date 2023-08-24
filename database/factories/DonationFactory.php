<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class DonationFactory extends Factory
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
                'amount' => $this->faker->randomFloat(2, 1, 1000),
                'donation_message' => $this->faker->sentence(),
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
        
    }
}
