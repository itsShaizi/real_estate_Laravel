<x-landing-layout>

<div class="bg-white -mt-32">
    <style type="text/css">
        .overlay {
            visibility: hidden;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay:target {
            visibility: visible;
        }
    </style>

    <div class="bg-center" style="background-image: url({{  !empty($project->images->first()) ? '/storage/projects/images/' . $project->id . '/thumb/' .$project->images->first()->title : '/images/resources/no-image-yellow.jpg' }})">
        <div class="h-96 bg-blue-500 bg-opacity-75">
            <div class="w-4/5 pt-5 pb-5 text-center mx-auto pt-40">
                <h1 class="text-white text-7xl pb-2">{{$project->name}}<span style="color:#FFD226">.</span></h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl lg:w-4/5 md:w-4/5 m-auto">
        <div class="m-5"> 
            <h1>{!! $project->content !!}</h1>
        </div>
        

        <div class="m-auto md:flex md:flex-wrap text-center px-1 pt-1" id="projects-list">

            @foreach($listings as $i => $listing)
            <div class="border-l border-r border-t flex flex-col md:flex-row mx-auto my-10 rounded-2xl shadow-xl w-11/12">
    
            <div class="bg-cover bg-no-repeat flex flex-col-reverse rounded-t-2xl md:rounded-tr-none md:rounded-l-2xl w-full md:w-1/3 h-56 md:h-auto" style="background-image: url({{  !empty($listing->images->first()) ? '/storage/listings/images/' . $listing->id . '/thumb/' .$listing->images->first()->title : '/images/resources/no-image-yellow.jpg' }})">
            </div>

            <div class="flex-cols w-full md:w-2/3">

                <div class="flex justify-between pl-4 py-5">
                    <div class="flex-1">   
                        <div>
                            <a href="/listing/{{ $listing->slug }}">
                                <h2 class="font-bold text-md md:text-3xl">
                                    @if($listing->listing_title)
                                    {{ $listing->listing_title }}
                                    @else
                                    {{ $listing->address }}
                                    @endif
                                </h2>
                                <h3 class="mt-2">
                                    @php
                                    if(!empty($listing->state_id)){
                                     $state = $listing->state->iso2;
                                    } else {
                                     $state = '';
                                    }
                                    if(!empty($listing->country_id)){
                                     $country = $listing->country->iso2;
                                    } else {
                                     $country = '';
                                    }
                                    $sub_title = '';
                                    $sub_title .= isset($listing->city) ? $listing->city : '';
                                    $sub_title .= isset($listing->county) ? ', '.$listing->county : '';
                                    $sub_title .= isset($listing->municipality) ? ', '.$listing->municipality : '';
                                    $sub_title .= isset($state) ? ', '.$state : '';
                                    $sub_title .= isset($listing->zip) ? ', '.$listing->zip : '';
                                    $sub_title .= isset($country) ? ', '.$country : '';
                                    @endphp
                                    {{$sub_title}}
                                    
                                </h3>
                            </a>
                        </div>
                    </div>

                    <div>
                    <div class="font-bold text-sm">
                        <div>
                            <div class="bg-realty mb-2 py-1 px-2 text-white text-center uppercase">
                                {{$listing->listing_type}}
                            </div>
                            <div class="bg-gray-100 py-1 px-2 text-realty text-center uppercase">{{$listing->property_type}}</div>
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
                                    background-image: url({{ !empty($listing->beds) ? '/images/resources/Vector_bed.png' : '/images/resources/Vector_bed_empty.png' }});
                                    background-repeat: no-repeat;">
                                    @if(!empty($listing->beds))
                                    <span>$listing->beds</span>
                                    @else
                                    <span>-</span>
                                    @endif
                                </div>
                            </div>

                            <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url({{ !empty($listing->baths) ? '/images/resources/Vector_bath.png' : '/images/resources/Vector_bath_empty.png' }});
                                background-repeat: no-repeat;">
                                    @if(!empty($listing->baths))
                                    <span>{{$listing->baths}}</span>
                                    @else
                                    <span>-</span>
                                    @endif
                            </div>
                            </div>
                                
                            <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url({{ !empty($listing->lot_size) ? '/images/resources/Vector_fence.png' : '/images/resources/Vector_fence_empty.png' }});
                                background-repeat: no-repeat;">

                                @if(!empty($listing->lot_size))
                                 <span class="mr-1">{{ $listing->lot_size }}{{ $listing->lot_size_unit }}</span>
                                @else
                                <span>-</span>
                                @endif
                            </div>
                            </div>
                                
                            <div class="h-8 pl-2 md:pl-0 md:h-1 w-1/2 md:w-auto">
                            <div class="flex bg-contain pl-8 w-6 h-6" style="
                                background-image: url({{ !empty($listing->property_size) ? '/images/resources/Vector_sqft.png' : '/images/resources/Vector_sqft_empty.png' }});
                                background-repeat: no-repeat;">

                                @if(!empty($listing->property_size))
                                 <span class="mr-1">{{ $listing->property_size }}{{ $listing->property_size_unit }}</span>
                                @else
                                <span>-</span>
                                @endif
                                
                            </div>
                            </div>


                            </div>
                        </div>

                        <div class="md:border-gray-400 md:border-l pl-6 pt-2 pr-2">
                            <div class="flex-cols">
                                <div class="text-sm">LIST PRICE</div>
                                <div class="flex justify-center md:justify-left">
                                    <div class="font-bold text-3xl md:text-5xl text-realty">{{ number_format($listing->list_price) }}</div>
                                    <div class="self-start font-bold text-realty text-sm">{{ $listing->list_price_unit }}</div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <div class="bg-yellow-300 font-bold py-2 px-8 text-center text-xs md:text-sm text-white mb-3">
                            <a href="/listing/{{ $listing->slug }}">VIEW DETAILS</a>
                        </div> 
                    </div>
                </div>

            </div>

        </div>
       @endforeach
       <div id="pagination" class="flex justify-center"> {!! $listings->links() !!} </div>

        </div> 
 
    </div>
</div>

</x-landing-layout>