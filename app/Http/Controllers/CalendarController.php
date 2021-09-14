<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\ListingAuction;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    public function index()
    {
        return view('backend.calendar');
    }

    public function events(Request $request)
    {
        return Auction::query()
            ->where('start_date', '>=', Carbon::parse($request->start)->format('Y-m-d'))
            ->where('end_date', '<=', Carbon::parse($request->end)->format('Y-m-d'))
            ->get()
            ->map(function ($auction) {
                return [
                    'id' => $auction->id,
                    'title' => $auction->name,
                    'start' => $auction->start_date . ' ' . $auction->start_time,
                    'end' => $auction->end_date . ' ' . $auction->end_time,
                    'url' => '/agent-room/auction/'.$auction->id.'/edit',
                    'start_date_time' =>  Carbon::parse($auction->start_date . ' ' . $auction->start_time)->format('d M, Y h:i a'),
                    'end_date_time' =>  Carbon::parse($auction->end_date . ' ' . $auction->end_time)->format('d M, Y h:i a'),
                    'description' => $auction->description,//Str::limit($auction->description, 25),
                    'listings' => ListingAuction::where('auction_id', $auction->id)->count(),
                ];
            });
    }
}
