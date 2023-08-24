<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'amount',
        'price',
    ];

    /**
     * Retrieve top sales in past 30 days.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getTopSales()
    {
        $startDate = now()->subMonths(3);
        $endDate = now();
        return self::whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('item_name')
            ->select('item_name', \DB::raw('SUM(amount) as total_sales'))
            ->orderByDesc('total_sales')
            ->take(3)
            ->get();
    }

    /**
     * Retrieve revenue of last 30 days sales.
     *
     * @return float
     */
    public static function getRevenue()
    {
        $startDate = now()->subDays(30);
        return MerchSale::where('created_at', '>=', $startDate)
            ->sum(\DB::raw('amount * price'));
    }
}
