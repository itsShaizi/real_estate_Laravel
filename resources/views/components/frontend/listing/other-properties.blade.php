<div>

    {{-- Desktop --}}
    <div x-data="{
        min: 0,
        max: 3,
        count: {{ $otherProperties->count() }},
        left(){
            if(this.min > 3){
                this.min -= 4;
                this.max -= 4;
            }else{
                this.min = 0;
                this.max = 3;
            }
        },
        right(){
            if(this.max < this.count - 1 ){
                this.min += 4;
                this.max += 4;
            }else{
                this.min = this.count - 4;
                this.max = this.count - 1;
            }
        },
    }" class="space-y-6 mb-6 md:mb-10 hidden lg:flex lg:flex-col">
        <div>
            <h3 class="text-center text-xl font-bold text-realty-light">{{ __('Other Properties in the Area') }}</h3>
        </div>
        <div class="relative flex flex-no-wrap space-x-4 items-center justify-center">
            <div class="text-gray-300 text-opacity-60 hover:text-opacity-90 cursor-pointer" x-on:click="left()">
                <x-icons.chevron-left class="h-14 w-14" />
            </div>

            @foreach ($otherProperties as $key => $listing)

            <div
                x-show="{{ $key }} >= min && {{ $key }} <= max"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-100"
                x-transition:enter-end="opacity-80"
                class="flex-none opacity-80 border border-gray-300 rounded-lg overflow-hidden hover:opacity-100 shadow-md hover:shadow-xl transition duration-200 ease-in-out cursor-pointer w-56">
                <a href="{{ route('listing', $listing) }}">
                    <img src="{{ !is_null($listing->images->first()) ? '/storage/listings/images/'.$listing->id.'/thumb/'.$listing->images->first()->title : '/images/resources/no-image-yellow.jpg' }}"
                        class="object-cover h-52 w-full" />
                    <div class="p-4 h-28">
                        <div class="text-realty-light font-semibold">{{ number_format($listing->list_price) }} USD
                        </div>
                        <div class="truncate text-sm">{{ $listing->address }}</div>
                        <div class="break-all text-sm">{{ $listing->city }} {{ $listing->state->iso2 }}</div>
                    </div>
                </a>
            </div>

            @endforeach

            <div class="text-gray-300 text-opacity-60 hover:text-opacity-90 cursor-pointer" x-on:click="right()">
                <x-icons.chevron-right class="h-14 w-14" />
            </div>
        </div>
    </div>

    {{-- Mobile --}}
    <div x-data="{
        active: 0,
        count: {{ $otherProperties->count() }},
        left(){
            if(this.active == 0){
                return;
            }else{
                this.active -= 1;
            }
        },
        right(){
            if(this.active == this.count ){
                return;
            }else{
                this.active += 1;
            }
        },
    }" class="space-y-6 mb-6 lg:mb-10 lg:hidden">
        <div>
            <h3 class="text-center text-xl font-bold text-realty-light">{{ __('Other Properties in the Area') }}</h3>
        </div>
        <div class="relative flex flex-no-wrap space-x-4 items-center justify-center">
            <div class="text-gray-300 text-opacity-60 hover:text-opacity-90 cursor-pointer" x-on:click="left()">
                <x-icons.chevron-left class="h-10 w-10" />
            </div>

            @foreach ($otherProperties as $key => $listing)

            <div
                x-show="{{ $key }} == active"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-100"
                x-transition:enter-end="opacity-80"
                class="flex-none opacity-80 border border-gray-300 rounded-lg overflow-hidden hover:opacity-100 shadow-md hover:shadow-xl transition duration-200 ease-in-out cursor-pointer w-56">
                <a href="{{ route('listing', $listing) }}">
                    <img src="{{ !is_null($listing->images->first()) ? '/storage/listings/images/'.$listing->id.'/thumb/'.$listing->images->first()->title : '/images/resources/no-image-yellow.jpg' }}"
                        class="object-cover h-52 w-full" />
                    <div class="p-4 h-28">
                        <div class="text-realty-light font-semibold">{{ number_format($listing->list_price) }} USD
                        </div>
                        <div class="truncate text-sm">{{ $listing->address }}</div>
                        <div class="break-all text-sm">{{ $listing->city }} {{ $listing->state->iso2 }}</div>
                    </div>
                </a>
            </div>

            @endforeach

            <div class="text-gray-300 text-opacity-60 hover:text-opacity-90 cursor-pointer" x-on:click="right()">
                <x-icons.chevron-right class="h-10 w-10" />
            </div>
        </div>
    </div>
</div>
