<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
                ];
            });
    }
}
