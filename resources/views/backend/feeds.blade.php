<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Feeds</h1>
        </div>
    </header>

    <hr />

    <!-- Feeds Table -->
    <x-backend.dynamic-table :headers="['Feed Name', 'Type', 'Status', 'Parser Class', 'Created', 'Edit']">
        @foreach($feeds as $i => $feed)
        <tr class="text-sm hover:bg-blue-100">
            <td class="text-base px-2 py-2">
                {{ $feed->name }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $feed->type }}</span>
            </td>
            <td class="auction-2 py-2 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $feed->status }}</span>
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $feed->feed_class }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $feed->created_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="user/{{ $feed->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <!-- This is an example component -->
    <div id="wrapper" class="w-full px-4 py-4 mx-auto">
        <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-4">
            <div id="jh-stats-positive" class="flex flex-col justify-center px-4 py-4 bg-white border border-gray-300 rounded">
                <div>
                    <div>
                        <p class="flex items-center justify-end text-green-500 text-md">
                            <span class="font-bold">6%</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 15a1 1 0 002 0V7a1 1 0 00-1-1h-8a1 1 0 000 2h5.59L13 13.59l-3.3-3.3a1 1 0 00-1.4 0l-6 6a1 1 0 001.4 1.42L9 12.4l3.3 3.3a1 1 0 001.4 0L20 9.4V15z"/></svg>
                        </p>
                    </div>
                    <p class="text-3xl font-semibold text-center text-gray-800">{{ number_format($stats['total_listings']) }}</p>
                    <p class="text-lg text-center text-gray-500">Total Listings</p>
                </div>
            </div>

            <div id="jh-stats-negative" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <div>
                        <p class="flex items-center justify-end text-red-500 text-md">
                            <span class="font-bold">6%</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M20 9a1 1 0 012 0v8a1 1 0 01-1 1h-8a1 1 0 010-2h5.59L13 10.41l-3.3 3.3a1 1 0 01-1.4 0l-6-6a1 1 0 011.4-1.42L9 11.6l3.3-3.3a1 1 0 011.4 0l6.3 6.3V9z"/></svg>
                        </p>
                    </div>
                    <p class="text-3xl font-semibold text-center text-gray-800">{{ number_format($stats['total_volume']) }} USD</p>
                    <p class="text-lg text-center text-gray-500">Total Volume</p>
                </div>
            </div>

            <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <div>
                        <p class="flex items-center justify-end text-gray-500 text-md">
                            <span class="font-bold">0%</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg>
                        </p>
                    </div>
                    <p class="text-3xl font-semibold text-center text-gray-800">{{ number_format($stats['average_dom']) }}</p>
                    <p class="text-lg text-center text-gray-500">Average DOM</p>
                </div>
            </div>

            <div id="jh-stats-neutral" class="flex flex-col justify-center px-4 py-4 mt-4 bg-white border border-gray-300 rounded sm:mt-0">
                <div>
                    <div>
                        <p class="flex items-center justify-end text-gray-500 text-md">
                            <span class="font-bold">0%</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/></svg>
                        </p>
                    </div>
                    <p class="text-3xl font-semibold text-center text-gray-800">{{ number_format($stats['average_price']) }} USD</p>
                    <p class="text-lg text-center text-gray-500">Average List Price</p>
                </div>
            </div>
        </div>
    </div>

    <div x-data="{filters: false}">
        <x-form action="{{ route('bk-feeds-filter') }}">
            <div class="flex justify-center">
                <div class="mt-2 w-full md:w-auto">
                    <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
                </div>
            </div>
            <div x-show.transition="filters" x-cloak>
                <!-- Filter Listings -->
                <x-backend.feed-filter title='Filter Feeds' class="text-sm"></x-backend.feed-filter>

            </div>
        </x-form>
    </div>



</x-backend.layout>