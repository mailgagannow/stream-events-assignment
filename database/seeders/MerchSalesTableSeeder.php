<?php

namespace Database\Seeders;

use App\Models\MerchSale;
use Illuminate\Database\Seeder;

class MerchSalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MerchSale::factory()->count(400)->create();
    }
}
