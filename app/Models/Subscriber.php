<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subscription_tier',
    ];

    /**
     * Retrieve the revenue from subscribers for past 30 days.
     *
     * @return float
     */
    public static function getRevenue()
    {
        $totalSubscriptionRevenue = 0;
        $startDate = now()->subDays(30);
        // Define tier prices
        $tierPrices = [
            '1' => 5,
            '2' => 10,
            '3' => 15,
        ];

        if (!empty($tierPrices)) {
            foreach ($tierPrices as $key => $price) {
                $totalSubscriptionRevenue += self::where('created_at', '>=', $startDate)
                    ->where('subscription_tier', $key)
                    ->count() * $price;
            }
        }

        return $totalSubscriptionRevenue;
    }
}
