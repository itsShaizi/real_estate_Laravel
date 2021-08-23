<div class="border h-auto p-5 rounded-2xl text-gray-600">
	<div class="border-b pb-2 text-right text-xs">
        <div>{{ $event_type }}</div>
        <div>{{ $event_date }}</div>
        <div>{{ $time_until_event }}</div> <!-- Time until event Starts / Ends -->
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between"><div>List Price:</div><div>${{ $listing_price }}</div></div>
        <div class="flex justify-between"><div>Sugg. Opening Bid:</div><div>${{ $suggest_opening_bid }}</div></div>
    </div>
    <form action="/pre-auction/{{ $listing_id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex items-center justify-between py-5">
            <div class="w-1/2">My Best Offer:</div>
            <div class="w-1/2">
                <x-input></x-input>
            </div>
        </div>
        <div class="mb-7 mt-2">
            <x-button>
                Place pre-event offer
            </x-button>
        </div>
    </form>
    <div class="text-sm">
    	What is a Pre-Event Offer? This property can be purchased prior to the event's start date. If accepted, this property will be removed from the upcoming auction. Benefits to purchasing prior to event.
		Want to wait until the event day to bid?
    </div>
</div>	