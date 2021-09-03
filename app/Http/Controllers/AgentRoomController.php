<?php

namespace App\Http\Controllers;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

use Illuminate\Support\Facades\Cache;

class AgentRoomController extends Controller
{
    public function __invoke()
    {

        if(! Cache::has('agent_room_most_visited')) {
            $analyticsData['most_visited'] = Analytics::fetchMostVisitedPages(Period::days(7));
            Cache::put('agent_room_most_visited', $analyticsData['most_visited'], now()->addHours(10));
        } else {
            $analyticsData['most_visited'] = Cache::get('agent_room_most_visited');
        }

        if(! Cache::has('agent_room_top_referrers')) {
            $analyticsData['top_referrers'] = Analytics::fetchTopReferrers(Period::days(7));
            Cache::put('agent_room_top_referrers', $analyticsData['top_referrers'], now()->addHours(24));
        } else {
            $analyticsData['top_referrers'] = Cache::get('agent_room_top_referrers');
        }

        if(! Cache::has('agent_room_top_countries')) {
            $analyticsData['top_countries'] = Analytics::performQuery(
                Period::days(7),
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions, ga:pageviews',
                    'dimensions' => 'ga:country',
                    'sort' => '-ga:sessions',
                    'max-results' => 20

                ]
            );
            Cache::put('agent_room_top_countries', $analyticsData['top_countries'], now()->addHours(24));
        } else {
            $analyticsData['top_countries'] = Cache::get('agent_room_top_countries');
        }

        if(! Cache::has('agent_room_top_keywords')) {
            $analyticsData['top_keywords'] = Analytics::performQuery(
                Period::days(7),
                'ga:keyword',
                [
                    'metrics' => 'ga:sessions',
                    'dimensions' => 'ga:keyword',
                    'sort' => '-ga:sessions',
                    'max-results' => 20

                ]
            );
            Cache::put('agent_room_top_keywords', $analyticsData['top_keywords'], now()->addHours(24));
        } else {
            $analyticsData['top_keywords'] = Cache::get('agent_room_top_keywords');
        }
        return view('backend.agent-room', ['analyticsData' => $analyticsData]);
    }
}
