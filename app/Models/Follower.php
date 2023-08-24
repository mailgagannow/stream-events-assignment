<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Retrieve a list of followers.
     *
     * @return int
     */
    public static function getFollowers()
    {
        $startDate = now()->subDays(30);

        return Follower::where('created_at', '>=', $startDate)
            ->count();
    }
}
