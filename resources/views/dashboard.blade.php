<x-app-layout>

<div class="bg-white">
    <div class="md:flex">
        <div class="md:w-1/5 md:bg-gray-200"> 
            <div class="flex flex-row h-36 justify-center justify-items-center">
                <div class="flex bg-white md:bg-gray-200 m-4">
                    @if (auth()->user()->avatar)
                        <img class="flex w-28 h-28 rounded-full" src="{{ auth()->user()->avatar }}">
                    @else
                        <img class="flex rounded-full" src="/img/sell/policy2.png">
                    @endif
                    <div class="flex flex-col font-bold ml-4 my-auto">
                        <h1 class="text-2xl md:text-xl">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </h1>
                        <h2 class="text-lg md:text-base">
                            {{ auth()->user()->email }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="flex justify-center bg-gray-800 text-white">
                <div x-data="{show: false}" @click.away="show = false"> 
                    <button @click="show = ! show" class="block bg-gray-800 text-white px-6 text-sm py-3 overflow-hidden focus:outline-none focus:border-white">
                        <div class="flex justify-between"> 
                            <span>Dashboard</span> <svg class="fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M7 10l5 5 5-5z" />
                                <path d="M0 0h24v24H0z" fill="none" /></svg> 
                        </div>
                    </button>
                    <div x-show="show" class="mt-2 py-2 bg-gray-800 text-white"> 
                        <a href="#" class="block px-4 py-2 text-gray-400 hover:text-white">Client Listing</a> 
                        <a href="#" class="block px-4 py-2 text-gray-400 hover:text-white">Cashyfyd</a> 
                        <a href="#" class="block px-4 py-2 text-gray-400 hover:text-white">My Bids/offers</a> 
                    </div>
                </div>
            </div>
        </div>

        <div class="md:w-4/5">
            <div class="bg-blue-200">
                <h1 class="text-2xl md:text-5xl font-bold text-center md:text-left align-middle py-4 md:py-12 md:ml-8">Client listing's stats</h1>
            </div>

            <div class="m-4">
                Sort by: <span class="sort" data-sort_by="address">Address</span> | <span class="sort" data-sort_by="price">Price</span> | <span class="sort" data-sort_by="views">Listing Views</span> | <span class="sort" data-sort_by="downloads">File Downloads</span> | <span class="sort" data-sort_by="exposure">Marketing Exposure</span> | <span class="sort auction-sort" style="display:none" data-sort_by="auction">Auction</span>
            </div>


            <div class="md:w-4/5 shadow-lg rounded-2xl h-auto mt-8 mx-4 md:mx-auto">
                <div class="md:flex text-center md:text-left bg-gray-300 md:w-1/2 p-2">
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase">Auction:</span>
                    <span class="text-xl md:text-3xl border-r-2 border-black px-2">15/12/22</span>
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase pl-2">Listed/Active</span>
                </div>

                <div class="text-center md:text-right text-lg md:text-2xl pr-2"><a href="#">Show detailed stats</a>
                </div>

                <div class="md:flex">
                    <div class="md:-ml-8 mt-2">
                        <img class="rounded-lg mx-auto" src="/img/sell/policy2.png"/>
                    </div>
                    <div class="md:ml-16">
                        <div class="flex flex-col mt-8 mb-8">
                            <div class="flex-none md:flex mb-4">
                                <div class="text-xl md:text-3xl md:mr-4 text-center md:text-left">
                                    <strong class="font-bold">9 Orchid Garden</strong>
                                    <div class="border-b-2 md:border-b-0 mx-4 md:mx-0">Belmopan, Cayo District, BZ</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>List Price</div>
                                        <div class="text-blue-400 font-bold">$753.021</div>
                                    </div>
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>Sugg. Opening Bid</div>
                                        <div>$603.321</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mx-4">
                            <div class="flex justify-between p-4 text-center md:text-left">
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Advertising<br />Impressions</div>
                                    <div class="font-bold">1.251.321</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Direct<br />views</div>
                                    <div class="font-bold">251.321</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Document<br />downloads</div>
                                    <div class="font-bold">23.235</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- listing -->

            <div class="md:w-4/5 shadow-lg rounded-2xl h-auto mt-8 mx-4 md:mx-auto">
                <div class="md:flex text-center md:text-left bg-gray-300 md:w-1/2 p-2">
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase">Auction:</span>
                    <span class="text-xl md:text-3xl border-r-2 border-black px-2">15/12/22</span>
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase pl-2">Listed/Active</span>
                </div>

                <div class="text-center md:text-right text-lg md:text-2xl pr-2"><a href="#">Show detailed stats</a>
                </div>

                <div class="md:flex">
                    <div class="md:-ml-8 mt-2">
                        <img class="rounded-lg mx-auto" src="/img/sell/policy2.png"/>
                    </div>
                    <div class="md:ml-16">
                        <div class="flex flex-col mt-8 mb-8">
                            <div class="flex-none md:flex mb-4">
                                <div class="text-xl md:text-3xl md:mr-4 text-center md:text-left">
                                    <strong class="font-bold">0.40 Acres of Vacant Land</strong>
                                    <div class="border-b-2 md:border-b-0 mx-4 md:mx-0">Takate, MA</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>List Price</div>
                                        <div class="text-blue-400 font-bold">$93.021</div>
                                    </div>
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>Sugg. Opening Bid</div>
                                        <div>$60.321</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mx-4">
                            <div class="flex justify-between p-4 text-center md:text-left">
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Advertising<br />Impressions</div>
                                    <div class="font-bold">291.221</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Direct<br />views</div>
                                    <div class="font-bold">25.721</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Document<br />downloads</div>
                                    <div class="font-bold">22.135</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:w-4/5 shadow-lg rounded-2xl h-auto mt-8 mx-4 md:mx-auto">
                <div class="md:flex text-center md:text-left bg-gray-300 md:w-1/2 p-2">
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase">Auction:</span>
                    <span class="text-xl md:text-3xl border-r-2 border-black px-2">1/11/21</span>
                    <span class="text-xl md:text-3xl text-blue-400 font-bold uppercase pl-2">Listed/Active</span>
                </div>

                <div class="text-center md:text-right text-lg md:text-2xl pr-2"><a href="#">Show detailed stats</a>
                </div>

                <div class="md:flex">
                    <div class="md:-ml-8 mt-2">
                        <img class="rounded-lg mx-auto" src="/img/sell/policy2.png"/>
                    </div>
                    <div class="md:ml-16">
                        <div class="flex flex-col mt-8 mb-8">
                            <div class="flex-none md:flex mb-4">
                                <div class="text-xl md:text-3xl md:mr-4 text-center md:text-left">
                                    <strong class="font-bold">80-71 Carrera 53</strong>
                                    <div class="border-b-2 md:border-b-0 mx-4 md:mx-0">Kingsford, MI, 49802, US</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>List Price</div>
                                        <div class="text-blue-400 font-bold">$325.021</div>
                                    </div>
                                    <div class="md:border-r-4 border-gray-400 md:border-blue-400"></div>
                                    <div class="text-xl md:text-3xl text-center md:text-left my-4 md:mx-4">
                                        <div>Sugg. Opening Bid</div>
                                        <div>$233.321</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mx-4">
                            <div class="flex justify-between p-4 text-center md:text-left">
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Advertising<br />Impressions</div>
                                    <div class="font-bold">251.321</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Direct<br />views</div>
                                    <div class="font-bold">21.321</div>
                                </div>
                                <div class="text-sm md:text-xl">
                                    <div class="text-blue-400 font-bold uppercase">Document<br />downloads</div>
                                    <div class="font-bold">3.235</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- listing -->
        </div>
    </div>
</div> <!--background-->
    

</x-app-layout>
