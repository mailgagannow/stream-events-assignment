<?php

namespace Database\Factories;

use App\Models\Follower;
use App\Models\MerchSale;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchSaleFactory extends Factory
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
                'customer_name' => $this->faker->name(),
                'item_name' => $this->faker->sentence(5),
                'amount' => $this->faker->numberBetween(1, 10),
                'price' => $this->faker->numberBetween(10, 100),
                'created_at' => $created_at,
                'updated_at' => $created_at
            ];
        
    }
}
