<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Country;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\AdditionalPropertyTypes;
use App\Http\Requests\Listings\UploadMediaRequest;
use App\Http\Requests\Listings\StoreListingRequest;
use App\Http\Requests\Listings\UpdateListingRequest;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::paginate(20);
        
        return view('backend.listings', ['listings' => $listings, 'countries' => Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.listing.create', [
            'additional_property_types' => AdditionalPropertyTypes::orderBy('name')->get(),
            'selected_additional_property_types' => [],
            'countries' => Country::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingRequest $request)
    {
        $listing = tap(Listing::create($request->validated()), function ($listing) use ($request) {
            if ($request->filled('realtyhive_rep')) {
                $this->saveContact($listing, User::find($request->realtyhive_rep), Group::find(29));
            }

            if ($request->filled('realtyhive_liaison')) {
                $this->saveContact($listing, User::find($request->realtyhive_liaison), Group::find(28)
                );
            }

            if ($request->filled('real_estate_agent')) {
                $this->saveContact($listing, User::find($request->real_estate_agent), Group::find(6));
            }
        });

        return redirect()->route('bk-listing-edit', $listing->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    //public function show(Listing $listing)
    public function show(Request $request)
    {
        $uri = str_replace("listing/", "", $request->path());
        $listing = Listing::with('auction')->where('slug', $uri)->first();
        $auction = !empty($listing->auction->count())?($listing->auction[0]):[]; 
        return view('frontend.listing', compact('listing','auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $listing = Listing::findOrFail($request->listing_id);

        return view('backend.listing.edit', [
            'listing' => $listing,
            'additional_property_types' => AdditionalPropertyTypes::query()
                ->whereNotIn('id', explode(',', $listing->additional_property_types))
                ->orderBy('name')
                ->get(),
            'selected_additional_property_types' => AdditionalPropertyTypes::query()
                ->whereIn('id', explode(',', $listing->additional_property_types))
                ->orderBy('name')
                ->get(),
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $listing->update($request->validated());

        if ($request->filled('realtyhive_rep')) {
            $this->saveContact($listing, User::find($request->realtyhive_rep), Group::find(29));
        }

        if ($request->filled('realtyhive_liaison')) {
            $this->saveContact($listing, User::find($request->realtyhive_liaison), Group::find(28)
            );
        }

        if ($request->filled('real_estate_agent')) {
            $this->saveContact($listing, User::find($request->real_estate_agent), Group::find(6));
        }

        return redirect()->route('bk-listing-edit', $listing->id)->with('success','Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        //
    }

    public function search(Request $request) {


    // DB::enableQueryLog();

        $listings = Listing::where(function ($query) use ($request) {
                        $query->where('address', 'LIKE', '%'.$request->s_query.'%')
                        ->orWhere('listing_title', 'LIKE', '%'.$request->s_query.'%')
                        ->orWhere('city', 'LIKE', '%'.$request->s_query.'%');
                    });
                    
        if($request->filled('property_type')) {
            $listings->where('property_type', $request->property_type);
        }
        if($request->filled('country')) {
            $listings->where('country_id', $request->country);
        }
        if($request->filled('state')) {
            $listings->where('state_id', $request->state);
        }
        if($request->filled('zip')) {
            $listings->where('zip', $request->zip);
        }
        if($request->filled('property_type')) {
            $listings->where('property_type', $request->property_type);
        }
        if($request->filled('listing_type')) {
            $listings->where('listing_type', $request->listing_type);
        }
        if($request->filled('status')) {
            $listings->where('status', $request->status);
        }
        if($request->filled('min_price')) {
            $listings->where('list_price', '>=', $request->min_price);
        }
        if($request->filled('max_price')) {
            $listings->where('max_price', '<=', $request->max_price);
        }

        $request->flash();

        $listings = $listings->paginate(20);

    // $queries = DB::getQueryLog();
    // dd($queries);

        return view('backend.listings', ['listings' => $listings, 'countries' => Country::all()]);
    }

    /**
     * Process the files upload from /agent-room/listing/{listing_id}/edit
     *
     * @param UploadMediaRequest $request
     * @param Listing $listing_id
     * @return void
     */
    public function uploadMedia(UploadMediaRequest $request, $listing_id)
    {
        if($request->hasFile('media')) {
            $listing = Listing::findOrFail($listing_id);

            (new \App\Actions\CreateImageAction)
                ->handle($listing, $request->file('media'));
        }
    }

    /**
     * Helper method to set relationships on Listings, Users and Groups 
     *
     * @param \App\Models\Listing $listing
     * @param \App\Models\User $user
     * @param \App\Models\Group $group
     * @return void
     */
    private function saveContact($listing, $user, $group)
    {
        $user->groups()->syncWithoutDetaching($group);

        $listing->contacts()->attach($user, ['group_id' => $group->id]);
    }
}
