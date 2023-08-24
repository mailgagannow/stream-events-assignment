<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'currency',
        'donation_message',
    ];

    /**
     * Retrieve donations made in the past 30 days.
     *
     * @return float
     */
    public static function getPast30DaysDonation()
    {
        // Calculate total revenue from Donations
        $startDate = now()->subDays(30);
        return Donation::where('created_at', '>=', $startDate)
            ->sum('amount');
    }
}
