<div class="border-l border-r border-t flex flex-col md:flex-row mx-auto my-10 rounded-2xl shadow-xl w-11/12" id="@{{ objectID}}" x-transition.duration.500ms>
    
    <div class="bg-cover bg-no-repeat flex flex-col-reverse rounded-t-2xl md:rounded-tr-none md:rounded-l-2xl w-full md:w-1/3 h-56 md:h-auto" style="
        background-image: url(@{{ image_link }});">
        <div class="bg-gray-800 opacity-60 pl-3 md:rounded-bl-2xl text-white text-xs">@{{ provider_name }}</div>
        <a href="/listing/@{{ slug }}">
            <img src="@{{ image_link }}" class="hidden">
        </a>
    </div>

    <div class="flex-cols w-full md:w-2/3">

        <div class="flex justify-between pl-4 py-5">
            <div class="flex-1">   
                <div>
                    <a href="/listing/@{{ slug }}">
                        <h2 class="font-bold text-md md:text-3xl">
                            @{{#helpers.highlight}}{ "attribute": "title" }@{{/helpers.highlight}}
                        </h2>
                        <h3 class="mt-2">
                            @{{#helpers.highlight}}{ "attribute": "sub_title" }@{{/helpers.highlight}}
                        </h3>
                    </a>
                </div>
            </div>
            <div>
                <div class="font-bold text-sm">
                    <div>
                        <div class="bg-realty mb-2 py-1 px-2 text-white text-center uppercase">
                            @{{ listing_type }}
                        </div>
                        <div class="bg-gray-100 py-1 px-2 text-realty text-center uppercase">@{{ property_type }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-cols">
            <div class="flex flex-col md:flex-row">
                <div class="flex-1 justify-between mt-2">
                    <div class="flex flex-wrap md:pl-4 flex md:block justify-between border-t-2 border-b-2 border-bottom-2 border-gray-100 pt-2 pb-2 md:border-0">

                        <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url(/images/resources/Vector_bed@{{^beds}}_empty@{{/beds}}.png);
                                background-repeat: no-repeat;">
                                @{{#beds}}<span>@{{ beds }}</span>@{{/beds}}
                                @{{^beds}}<span>-</span>@{{/beds}}
                            </div>
                        </div>

                        <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url(/images/resources/Vector_bath@{{^baths}}_empty@{{/baths}}.png);
                                background-repeat: no-repeat;">
                                @{{#baths}}<span>@{{ baths }}</span>@{{/baths}}
                                @{{^baths}}<span>-</span>@{{/baths}}
                            </div>
                        </div>
                        
                        <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url(/images/resources/Vector_fence@{{^lot_size}}_empty@{{/lot_size}}.png);
                                background-repeat: no-repeat;">
                                @{{#lot_size}}<span class="mr-1">@{{ lot_size }}</span>@{{ lot_size_unit }}@{{/lot_size}}
                                @{{^lot_size}}<span>-</span>@{{/lot_size}}
                            </div>
                        </div>
                        
                        <div class="h-8 pl-2 md:pl-0 md:h-1 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url(/images/resources/Vector_sqft@{{^property_size}}_empty@{{/property_size}}.png);
                                background-repeat: no-repeat;">
                                @{{#property_size}}<span class="mr-1">@{{ property_size }}</span>@{{ property_size_unit }}@{{/property_size}}
                                @{{^property_size}}<span>-</span>@{{/property_size}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:border-gray-400 md:border-l pl-6 pt-2 pr-2">
                    <div class="flex-cols">
                        <div class="text-sm">LIST PRICE</div>
                        <div class="flex justify-center md:justify-left">
                            <div class="font-bold text-3xl md:text-5xl text-realty">@{{ list_price_formatted }}</div>
                            <div class="self-start font-bold text-realty text-sm"> @{{ list_price_unit }}</div>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="flex flex-row-reverse">
                <div class="bg-yellow-300 font-bold py-2 px-8 text-center text-xs md:text-sm text-white mb-3">
                    <a href="/listing/@{{ slug }}">VIEW DETAILS</a>
                </div> 
            </div>
        </div>

    </div>

</div>
