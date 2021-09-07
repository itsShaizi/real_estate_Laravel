<x-backend.section title="Listings">

           <div x-data="projectListings()" x-init="loadListings()">

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
                                    <i class="fas fa-plus-circle"></i> Add to Project
                                </div>
                            </div>

                        </template>
                    </ul>

                </div>

                <div>
                    <x-backend.dynamic-table :headers="['Address', 'City', 'State', 'Country', 'Price', 'Action']">
                        <template x-for="listing in project_listings">
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