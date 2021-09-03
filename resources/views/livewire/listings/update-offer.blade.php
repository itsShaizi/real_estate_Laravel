<div 
    @update-offer.windows="updateOffer = true"
    @offer-updated.windows="updateOffer = false"
>
    <div x-show.transition="updateOffer">
        <hr class="my-4"/>
        @if ($offer)
            <div class="grid gap-4 grid-cols-2 md:grid-cols-4 place-items-center">
                <x-backend.avatar-name :path="$offer->user->avatar" :name="$offer->user->first_name . ' ' . $offer->user->last_name">
                    <x-slot name="altName">
                        {{ $offer->user->first_name .' '. $offer->user->last_name }}<br>
                        {{ $offer->user->email }}
                    </x-slot>
                </x-backend.avatar-name>
                <div>
                    <p>Listing Price</p>
                    {{ number_format($offer->listing->list_price) }} {{ $offer->listing->list_price_unit }}
                </div>
                <div>
                    <p>Offer Amount</p>
                    {{ number_format($offer->offer_amount) }} {{ $offer->listing->list_price_unit }}
                </div>
                <div>
                    <p>Date & Time</p>
                    {{ $offer->created_at->format('M, d Y H:i') }}
                </div>
            </div>
            <div class="grid gap-4 md:grid-cols-5 mt-4">
                <div class="col-span-2">
                    <x-label>
                        Outcome
                    </x-label>
                    <x-select wire:model.defer="outcome">
                        <option value="">-</option>
                        @foreach ( __('global.listing.offer_outcome') as $val => $name )
                            <option value="{{ $val }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-span-2">
                    <x-label>
                        Details
                    </x-label>
                    <x-input wire:model.defer="details" type="text" />
                </div>
                <div class="grid place-content-end">
                    <x-button type="button" wire:click="update">Update</x-button>
                </div>
                <div class="col-span-2 -mt-3">
                    <x-input-error for="outcome" />
                </div>
                <div class="col-span-2 -mt-3">
                    <x-input-error for="details" />
                </div>
            </div>
        @endif
    </div>
</div>