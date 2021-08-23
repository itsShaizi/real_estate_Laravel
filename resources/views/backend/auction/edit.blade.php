<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-auction-update', $auction->id) }}">
            
            <input type="hidden" name="id" value="{{$auction->id}}">
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Update Auction</h1>
                </div>
                <div>
                    <x-button>Save Auction</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div>
                    <div class="md:flex md:justify-between text-sm">
                        <div class="p-2">
                            <x-label>
                                Auction Name <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-input name="name" value="{{ $auction->name ?? old('name') }}"/>
                        </div>

                        <div class="p-2">
                            <x-label>
                                Start Date and Time <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-date-picker name="start_date" value="{{ $auction->start_date ?? old('start_date') }}"></x-date-picker>
                            <x-time-picker name="start_time" value="{{ $auction->start_time ?? old('start_time') }}"></x-time-picker>
                        </div>
                        <div class="p-2">
                            <x-label>
                                End Date and Time <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-date-picker name="end_date" value="{{ $auction->end_date ?? old('end_date') }}"></x-date-picker>
                            <x-time-picker name="end_time" value="{{ $auction->end_time ?? old('end_time') }}"></x-time-picker>
                        </div>
                        <div class="p-2 md:w-1/2">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea name="description" placeholder="Describe the Auction Event" value="{{ $auction->description ?? old('description') }}"></x-textarea>
                        </div>
                    </div>
                </div>
            </x-backend.section>
                
        </x-form>

        <x-backend.section title="Listings">

           <div x-data="auctionListings()" x-init="loadListings()">

                <x-input type="text" name="search" @keyup="search()" x-model="query" placeholder="Search Listing Term..."></x-input>

                <div class="relative w-full">

                    <ul class="w-full bg-white absolute p-3 border border-gray-300 rounded-md shadow-lg" x-show="show_results">
                        <template x-for="listing in query_results">
                            
                            <div class="flex justify-between border-b mb-2 pb-1 hover:border-blue-400">
                                <div class="flex flex-row">
                                    <img :src="listing.image_link" class="w-14 h-14" />
                                    <div class="flex-column ml-2">
                                        <strong x-text="listing.address"></strong>
                                        <p x-text="listing.city + ', ' + listing.state_name + ', ' + listing.country_name"></p>
                                    </div>
                                    <div class="flex ml-4">
                                        <div class="font-bold text-xl md:text-2xl text-realty" x-text="number_format(listing.list_price)"></div>
                                        <div class="self-start font-bold text-realty text-sm" x-text="listing.list_price_unit ? listing.list_price_unit : 'USD'"></div>
                                    </div>
                                </div>
                                <div class="cursor-pointer text-realty" @click="addListing(listing)">
                                    <i class="fas fa-plus-circle"></i> Add to Auction
                                </div>
                            </div>

                        </template>
                    </ul>

                </div>

                <div>
                    <x-backend.dynamic-table :headers="['Address', 'City', 'State', 'Country', 'Price', 'Action']">
                        <template x-for="listing in auction_listings">
                            <x-backend.table-row>
                                <td class="px-2 py-2 whitespace-nowrap" x-text="listing.address"></td>
                                <td class="px-2 py-2 whitespace-nowrap" x-text="listing.city"></td>
                                <td class="px-2 py-2 whitespace-nowrap" x-text="listing.state_name"></td>
                                <td class="px-2 py-2 whitespace-nowrap" x-text="listing.country_name"></td>
                                <td class="px-2 py-2 whitespace-nowrap" x-text="listing.formatted_price"></td>
                                <td class="px-2 py-2 whitespace-nowrap"><div class="cursor-pointer text-realty" @click="removeListing(listing)"><i class="fas fa-minus-circle"></i> Remove</div></td>
                            </x-backend.table-row>
                        </template>
                    </x-backend.dynamic-table>
                </div>


            </div>

        </x-backend.section>

    </div>

</x-backend.layout>




<script>

function auctionListings() {
    return {
        auction_id: <?=$auction->id?>,
        query: '',
        show_results: false,
        query_results: [],
        auction_listings: [],
        async search() {
            this.query_results = [];
            let response = await fetch('/api/listings/search/'+this.query);
            let data = await response.json();
            this.query_results = data;
            if(this.query_results.length > 0) this.show_results = true;
            else this.show_results = false;
        },
        addListing(listing) {
            this.show_results = false;
            if (_.findIndex(this.auction_listings, { 'id': listing.id }) === -1) {
                this.auction_listings.push(listing);
            } 
            fetch('/agent-room/auction/'+this.auction_id+'/listing/'+listing.id+'/add', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
        },
        removeListing(listing) {
            this.auction_listings = this.auction_listings.filter(function( obj ) {
                return obj.id !== listing.id;
            });
            fetch('/agent-room/auction/'+this.auction_id+'/listing/'+listing.id+'/remove', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
        },
        async loadListings() {
            let response = await fetch('/agent-room/auction/'+this.auction_id+'/listings');
            let data = await response.json();
            this.auction_listings = data;
        }
    }
}

</script>