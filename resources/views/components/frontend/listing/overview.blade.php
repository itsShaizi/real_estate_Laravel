<div>
    <div class="border-b flex justify-between p-10">
        <div>{{ property_size($listing->property_size) }} {{ __(config('localization.available_meassures')[config('localization.meassure')]['property_size_unit']) }}</div>
        <div>{{ lot_size($listing->lot_size) }} {{ __(config('localization.available_meassures')[config('localization.meassure')]['lot_size_unit']) }}</div>
        <div>{{ $listing->beds }} - beds</div>
        <div>{{ $listing->baths }} - baths</div>
    </div>
    <div class="flex mt-10">
        <div class="flex flex-1 leading-loose px-5">
            <div class="flex-1">                                 
                @if($listing->title)
                <div>Title</div>
                <div class="font-bold">{{ $listing->title }}</div>
                @endif
                <div>Address</div>
                <div class="font-bold">{{ $listing->address }}</div>
                <div>City</div>
                <div class="font-bold">{{ $listing->city }}</div>
                <div>State</div>
                <div class="font-bold">{{ $listing->state->name }}</div>
                <div>Country</div>
                <div class="font-bold">{{ $listing->country->name }}</div>
            </div>
            <div class="flex-1">
                <div>Property Type</div>
                <div class="font-bold">{{ $listing->property_type }}</div>
                <div>Property Size</div>
                <div class="font-bold">{{ property_size($listing->property_size) }} {{ __(config('localization.available_meassures')[config('localization.meassure')]['property_size_unit']) }}</div>
                <div>Lot Size</div>
                <div class="font-bold">{{ lot_size($listing->lot_size) }} {{ __(config('localization.available_meassures')[config('localization.meassure')]['lot_size_unit']) }}</div>
                <div>Data Source</div>
                <div class="font-bold">{{ $listing->provider_name }}</div>
                <div>MLS Number(s)</div>
                <div class="font-bold"><a href="{{ $listing->listing_source }}">Link</a></div>
            </div>
        </div>
                            
        <div class="flex-1">
            <x-map :lat="$listing->latitude" :long="$listing->longitude" class="h-full w-auto rounded-2xl"></x-map>
        </div>
    </div>

    <div class="leading-6 mt-5 text-sm">
        <h3 class="font-bold text-realty uppercase">Property Information</h3>
        <p>
            {{ $listing->description }}
        </p>
    </div>

</div>

