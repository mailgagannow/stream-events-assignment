<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Follower;
use App\Models\MerchSale;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    /**
     * Get events based on the request parameters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEvents(Request $request)
    {
        $startDate = now()->subMonths(3);
        $endDate = now();
        $perPage = $request->input('per_page', 25); // Number of items per page
        $page = $request->input('page', 1); // Current page

        $subscribers = Subscriber::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $sales = MerchSale::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $followers = Follower::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $donations = Donation::whereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);

        // Merge the paginated data into a single collection
        $combinedData = $subscribers->concat($sales)->concat($followers)->concat($donations)->shuffle();

        // Create a custom pagination instance from the merged data
        $combinedPaginator = new LengthAwarePaginator(
            $combinedData->forPage($page, $perPage),
            $combinedData->count(),
            $perPage,
            $page
        );

        $events = [];

        // Add custom messages based on the table from which the data came
        foreach ($combinedData as $record) {
            if ($record instanceof Subscriber) {
                $event = "User {$record->name} tier{$record->subscription_tier} subscribed to you.";
            } elseif ($record instanceof MerchSale) {
                $event = "User {$record->customer_name} bought some {$record->item_name} from you at {$record->price} USD .";
            } elseif ($record instanceof Follower) {
                $event = "User {$record->name} followed you!.";
            } else {
                $event = "User {$record->name} donated {$record->amount} {$record->currency} to you!. {$record->donation_message}";
            }

            $events[] = $event;
        }

        $salesData = MerchSale::getTopSales();
        $past30DaysFollowers = Follower::getFollowers();
        $totalRevenue = Donation::getPast30DaysDonation() + MerchSale::getRevenue() + Subscriber::getRevenue();

        // Customize the JSON response
        $response = [
            'totalRevenue' => $totalRevenue,
            'past30DaysFollowers' => $past30DaysFollowers,
            'sales' => $salesData,
            'events' => $events,
            'current_page' => $combinedPaginator->currentPage(),
            'per_page' => $perPage,
            'total' => $combinedPaginator->total(),
        ];

        // Add "next" and "prev" URLs if they exist
        if ($combinedPaginator->hasMorePages()) {
            $response['next_page_url'] = $combinedPaginator->nextPageUrl();
        }
        if ($combinedPaginator->currentPage() > 1) {
            $response['prev_page_url'] = $combinedPaginator->previousPageUrl();
        }

        return response()->json($response);
    }

}
