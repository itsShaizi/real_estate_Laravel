<?php

namespace App\Http\Controllers;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class AgentRoomController extends Controller
{
    public function __invoke()
    {

    	//retrieve visitors and pageview data for the current day and the last seven days
		//$analyticsData['visitors_week'] = Analytics::fetchVisitorsAndPageViews(Period::days(7));

		$analyticsData['most_visited'] = Analytics::fetchMostVisitedPages(Period::days(7));

		$analyticsData['top_referrers'] = Analytics::fetchTopReferrers(Period::days(7));
		// //retrieve visitors and pageviews since the 6 months ago
		// $analyticsData['visitors_month'] = Analytics::fetchVisitorsAndPageViews(Period::months(6));

		// //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
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

        return view('backend.agent-room', ['analyticsData' => $analyticsData]);
    }
}
