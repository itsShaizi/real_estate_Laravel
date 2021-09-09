<div class="border h-auto p-5 rounded-2xl text-gray-600">
	<div class="border-b pb-2 text-right text-xs">
		<div>Online Only Event/Auction:</div>
		<div>
            @if(!empty($auction))
                {{ date('F jS h:i A', strtotime($auction->start_date . ' ' . $auction->start_time)) }}
                -
                @if($auction->start_date != $auction->end_date)
                    {{ date('F jS h:i A', strtotime($auction->end_date . ' ' . $auction->end_time)) }}
                @else
                    {{ date('h:i A', strtotime(' ' . $auction->end_time)) }}
                @endif
            @endif
        </div>
        @if(!empty($auction))
            <x-frontend.listing.auction-countdown :auction="$auction" />
        @endif
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between">
            <div>List Price:</div>
            <div>{{ price($list_price) }}</div>
        </div>
        @if ($eventIsActive)
            <div class="flex justify-between">
                <div>
                    @if ($listing->listing_type === 'auction')
                        Highest Bid:
                    @elseif ($listing->listing_type === 'auction_managed')
                        Sugg. Opening Bid:
                    @endif
                </div>
                <div>
                    {{ price($current_bid_suggestion) }}
                </div>
            </div>
        @endif
    </div>
    @if ($listing->listing_type === 'auction')
        <div x-data="{ show_previous_bids : false }">
            <a @click="show_previous_bids = ! show_previous_bids" class="cursor-pointer text-sm hover:text-blue-600">Toggle previous bids</a>
            <div class="max-h-36 overflow-y-scroll" x-show="show_previous_bids" x-cloak>
                <div>
                    @foreach ($previous_bids as $bid)
                        <div class="flex justify-between w-full text-sm text-center border {{ $loop->odd ? 'bg-gray-100' : 'bg-green-100' }}">
                            <span>
                                {{ $bid['created_at'] }}
                            </span>
                            <span>
                                {{ price($bid['offer_amount']) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(!empty($auction) && $eventIsActive)
        <form wire:submit.prevent="submit">
            <div class="flex items-center justify-between pt-5">
                <div class="w-1/2">
                    @if ($listing->listing_type === 'auction')
                        My Max Bid:
                    @elseif ($listing->listing_type === 'auction_managed')
                        My Best Offer:
                    @endif
                </div>
                <div class="w-1/2">
                    <x-input wire:model.defer="offer_amount"></x-input>
                </div>
            </div>
            <div class="text-xs text-right mt-1">
                <span>Enter <b>{{ price($current_bid_suggestion + 1) }}</b> or more</span>
            </div>
            <div class="mb-7 mt-2">
                <x-button class="flex justify-center w-full active:bg-blue-9700 bg-blue-600 hover:bg-blue-400 focus:border-blue-700 disabled:opacity-80">
                    <span wire:loading.remove>
                        @if ($listing->listing_type === 'auction')
                            Bid now!
                        @elseif ($listing->listing_type === 'auction_managed')
                            Place pre-event offer
                        @endif
                    </span>
                    <x-icons.animated-spin wire:loading />
                    <span wire:loading>Submitting...</span>
                </x-button>
            </div>
            <div 
                x-data="{ message_show : false, message : null, message_details : null }"
                x-init="
                    document.addEventListener('show-message', event => {
                        message = event.detail.message;
                        message_details = event.detail.message_details;
                        message_show = true;
                    });
                "
            >
                <x-frontend.listing.message />
            </div>
        </form>
        <div class="text-sm">
            @if ($listing->listing_type === 'auction')
                This event is now live! Don't miss out on your chance to own this great opportunity. Bid now to secure your offer.
            @elseif ($listing->listing_type === 'auction_managed')
                What is a Pre-Event Offer? This property can be purchased prior to the event's start date. If accepted, this property will be removed from the upcoming auction. Benefits to purchasing prior to event. Want to wait until the event day to bid?
            @endif
        </div>
    @endif
    <div class="text-sm mt-4 text-blue-300 pointer">
        Wondering how the event process works with RealtyHive.com? Click here.
    </div>
    <div 
        x-data="{ on : false, alert_message : null }"
        x-init="
            document.addEventListener('alert-message', event => {
                alert_message = event.detail.alert_message;
                on = true;
            });
        "
    >
        <x-alert title="Something Went Wrong">
            <div x-text="alert_message"></div>
        </x-alert>
    </div>
    <x-login-modal />
</div>