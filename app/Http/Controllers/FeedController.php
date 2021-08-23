<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Listing;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::all();
        $stats['total_listings'] = DB::table('listings')->whereNotNull('feed_source')->count();
        $stats['total_volume'] = DB::table('listings')->whereNotNull('feed_source')->sum('list_price');
        $stats['average_dom'] = (float) DB::table('listings')->select(DB::raw('AVG( DATEDIFF (NOW() , listing_date)) as days'))->whereNotNull('feed_source')->get('days')->toArray()[0]->days;
        $stats['average_price'] = DB::table('listings')->whereNotNull('feed_source')->avg('list_price');
        
        return view('backend.feeds', ['feeds' => $feeds, 'stats' => $stats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter() {
        $feeds = Feed::all();
        return view('backend.feeds', ['feeds' => $feeds]);
    }
}
