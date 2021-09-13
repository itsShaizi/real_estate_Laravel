<x-search-layout>

    <div x-data="showComponents()" class="border-b-2 border-blue-300">

        <div class="flex justify-between query-wrapper p-4 z-50 bg-white">
            <div id="searchbox" class="flex-1 py-2"></div>

            <div id="filters-switch" class="flex py-2 hidden md:block">
                <x-button-div-sec-chevron click="toggleFilters()" chevron="filters_on">Toggle Search Filters</x-button-div-sec-chevron>
            </div>
            <div id="stats" class="py-1 px-2 mx-2 my-4 bg-realty rounded-full text-white text-sm hidden md:block"></div>

            <div id="map_switch" class="py-1 hidden md:block">
                <label for="checked" class="mt-3 inline-flex items-center cursor-pointer" x-transition.duration.500ms>
                    <span class="relative" @click="toogleMap()">
                        <span class="block w-10 h-6 bg-gray-200 rounded-full shadow-inner"></span>
                        <span :class="map_on ? 'bg-realty transform translate-x-full' : 'bg-white'" class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input type="checkbox" class="absolute opacity-0 w-0 h-0" />
                        </span>
                    </span>
                    <span class="ml-3 text-sm" x-text="map_on ? 'Map On' : 'Map Off'"></span>
                </label>
            </div>
        </div>

        <div id="filters" class="flex justify-around h-auto w-full h-auto bg-white transition-all pb-4 hidden md:flex" x-show.transition.duration.100ms.scale.30.origin.top="filters_on">
            <div class="flex-cols">
                <div class="h-20">
                    <label for="property-size-refinement">Property Size Range:</label>
                    <div class="-mt-2" id="property-size-refinement"></div>
                </div>
                <div class="h-20">
                    <label for="lot-size-refinement">Lot Size Range:</label>
                    <div class="-mt-2" id="lot-size-refinement"></div>
                </div>
                <div class="h-20">
                    <label for="price-refinement">Price Range:</label>
                    <div class="-mt-2" id="price-refinement"></div>
                </div>
            </div>
            <div class="flex-cols">
                <label for="state-refinement">State / Province:</label>
                <div id="state-refinement"></div>
                <label for="country-refinement">Country:</label>
                <div id="country-refinement"></div>
                <label for="property-type-refinement">Property Type:</label>
                <div id="property-type-refinement"></div>
                <label for="listing-type-refinement">Listing Type:</label>
                <div id="listing-type-refinement"></div>
            </div>
            <div>
                <label for="beds-refinement">Bedrooms:</label>
                <div id="beds-refinement"></div>
            </div>
            <div>
                <label for="baths-refinement">Bathrooms:</label>
                <div id="baths-refinement"></div>
                <div id="clear-filters" class="bg-gray-300 p-4 mt-4 text-white rounded-full hover:bg-blue-400 transition-all cursor-pointer"></div>
            </div>
        </div>

        <div id="list_map_switch" class="flex items-center justify-center md:hidden">
            <div class="absolute bg-white py-1 px-4 rounded-full drop-shadow-lg mt-14 border-2 border-blue-300">
                <label for="checked" class="mt-2 inline-flex items-center cursor-pointer" x-transition.duration.500ms>
                    <span class="relative" @click="toogleMap()">
                        <span class="block w-10 h-6 bg-gray-200 rounded-full shadow-inner"></span>
                        <span :class="map_on ? 'bg-realty transform translate-x-full' : 'bg-realty'" class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out">
                            <input type="checkbox" class="absolute opacity-0 w-0 h-0" />
                        </span>
                    </span>
                    <span class="ml-3 text-sm" x-text="map_on ? 'Show List' : 'Show Map'"></span>
                </label>
            </div>
        </div>

        <div class="h-screen flex overflow-y-scroll absolute inset-0 pt-52 -z-10" id="listings-list">

            <div :class="map_on ? 'hidden md:block md:w-3/5' : 'w-full md:w-full'">
                <div id="hits" class="flex-1 flex-cols border-r border-grey-400">
                    <div>
                        <x-frontend.search-card></x-frontend.search-card>
                    </div>
                </div>
                <div id="pagination" class="flex justify-center"></div>
            </div>

            <div :class="map_on ? 'w-full md:w-2/5' : 'hidden md:block md:w-0'" class="sticky top-0" x-show.transition.duration.100ms.scale.60.origin.right="map_on">
                <div id="map"></div>
            </div>

        </div>

    </div>


    <script src="https://maps.googleapis.com/maps/api/js?v=weekly&key=AIzaSyBqCLn0PkcVlSXmRMFBYWYvoB58UHjV7dw"></script>
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>

    <script src="js/search.js"></script>


</x-search-layout>
