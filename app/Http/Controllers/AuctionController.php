<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\ListingAuction;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::paginate(20);
        return view('backend.auctions', ['auctions' => $auctions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auction = Auction::create($request->all());
        //if there's a list of listings, get add them to the listing_auction table
        return redirect()->route('bk-auctions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {

        return view('backend.auction.edit', ['auction' => $auction]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auction $auction)
    {
        $auction->name = $request->name;
        $auction->start_date = $request->start_date;
        $auction->start_time = $request->start_time;
        $auction->end_date = $request->end_date;
        $auction->end_time = $request->end_time;
        $auction->update();
        return redirect()->route('bk-auctions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }

    public function add_listing(Request $request, Auction $auction, Listing $listing) {
        $listing_auction = new ListingAuction;
        $listing_auction->listing_id = $listing->id;
        $listing_auction->auction_id = $auction->id;
        if($listing_auction->save()){
            Listing::where('id',$listing->id)->update(['listing_type'=>'auction']);
            return true;
        }
        else
            return false;
    }

    public function remove_listing(Request $request, Auction $auction, Listing $listing) {
        //Laravel models don't support composite keys, we can only do this using DB
        if(DB::table('listing_auction')->where('listing_id', $listing->id)->where('auction_id', $auction->id)->delete())
            return true;
        else
            return false;

    }

    public function listings(Auction $auction) {
        $listings = ListingAuction::where('auction_id', $auction->id)->get('listing_id')->toArray();
        $listings = Arr::flatten($listings);
        return Listing::whereIn('id', $listings)->get()->toArray();
    }
}
