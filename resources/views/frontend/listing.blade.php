<x-app-layout>

    @include('layouts.preferences')

    <div class="bg-white">

        <div class="absolute top-0 right-0 z-50" id="offers-notifications-wrapper"></div>

        <main class="border-b-2 p-4 md:p-0 md:mt-0 md:pt-10 mx-auto pb-10 w-full md:w-4/5 md:flex md:flex-col">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-2/3 w-full"> <!-- LEFT SIDE -->
                    <div class="mb-4">
                        <h2 class="font-bold mb-4 text-4xl">{{ $listing->listing_title }}</h2>
                        <p class="font-bold mb-1 text-gray-700 text-xl">{{ $listing->address }}</p>
                        <div class="text-xs">Property ID: #{{ $listing->id }} // {{ $listing->property_type }}</div>
                    </div>

                    <div class="relative" x-data="{
                        imgModal : false,
                        active : 0,
                        count : {{ $listing->images->count() - 1 }},
                        left() { this.active = this.active === 0 ? this.count : this.active - 1 },
                        right() { this.active = this.active === this.count ? 0 : this.active + 1 }
                    }">
                        <div class="absolute bottom-0 left-0 h-150 w-8 p-2 z-10 bg-blue-400 bg-opacity-25 hover:bg-opacity-60 cursor-pointer py-16" onclick="move('left')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute bottom-0 right-0 box-border h-150 w-8 p-2 z-10 bg-blue-400 bg-opacity-25 hover:bg-opacity-60 cursor-pointer py-16" onclick="move('right')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>

                        <!-- Full Size Image Modal -->
                        <x-images-modal :listing="$listing">

                            <x-slot name="trigger">
                                <!-- Selected Image -->
                                <div @click="imgModal = ! imgModal" style="width: auto;" class="border border-gray-200 overflow-hidden relative rounded-2xl mr-2 cursor-pointer">
                                    <div class="demo-wrap"></div>
                                    <div class="absolute bgcolor-grey-400 h-full w-full flex justify-center z-10 bg-gray-700 opacity-60 hidden" id="image-loader">
                                        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-blue-400 self-center"></div>
                                    </div>
                                    <img src="/storage/listings/images/{{$listing->id}}/original/{{$listing->images[0]->title}}" style="max-height: 525px;display: block;" class="mx-auto relative" id="main-image">
                                </div>
                            </x-slot>

                        </x-images-modal>

                        <div class="flex flex-no-wrap overflow-x-scroll scrolling-touch no-scrollbar items-start" id="thumbnails">
                            @foreach($listing->images as $key => $image)
                            <div class="flex-none opacity-50 hover:opacity-100 transition duration-200 ease-in-out cursor-pointer mt-2 mr-2"><img src="/storage/listings/images/{{$listing->id}}/thumb/{{$image->title}}" class="max-h-40 w-auto" onclick="switchImage('{{$image->title}}')" @click="active = {{ $key }}"></div>
                            @endforeach
                        </div>

                    </div>

                    <div class="mt-4 md:mt-10">
                        <div  x-data="setTabs()">
                            <ul class="flex justify-center items-center my-4">
                                <template x-for="(tab, index) in tabs" :key="index">
                                    <li class="text-center w-1/4 cursor-pointer py-2 px-4 text-gray-500 border-b-2" :class="activeTab===index ? 'text-realty border-b-2 border-blue-500' : ''" @click="activeTab = index" x-text="tab"></li>
                                </template>
                            </ul>
                            <div x-show="activeTab===0">
                                <x-frontend.listing.overview :listing="$listing"></x-frontend.listing.overview>
                            </div>
                            <div x-show="activeTab===1">
                                documents
                            </div>
                            <div x-show="activeTab===2">
                                due diligence
                            </div>
                            <div x-show="activeTab===3">
                                buying tips
                            </div>
                        </div>
                    </div>

                </div>

                <div class="md:ml-10 md:w-1/3 md:mt-20">

                    @if ($listing->listing_type == 'auction' || $listing->listing_type == 'auction_managed')
                        <livewire:listings.frontend.auction-offer :listing="$listing" />
                    @elseif ($listing->listing_type == 'traditional')
                        <livewire:listings.frontend.traditional-sale :listing="$listing" />
                    @endif

                    <div class="flex items-center mb-5 pl-5 pt-5 text-realty">
                        <img src="http://realtyhive.com/images/resources/star_empty.png" class="h-8 mr-5">
                        <a href="#" class="">Add to watchlist</a>
                    </div>

                    <x-frontend.listing.get-cash-back>$9,659</x-frontend.listing.get-cash-back>

                    <x-frontend.listing.speak-to-agent :agent="$listing->agent ?? $listing->contacts->first()" :listing="$listing" />

                    <x-frontend.listing.financing-card></x-frontend.listing.financing-card>


                </div>
            </div>
            <div>
                <hr class="my-4 md:my-10">

                <x-frontend.listing.other-properties :otherProperties="$otherProperties"/>
            </div>
        </main>

    </div>

    <x-login-modal />

</x-app-layout>

<script>
    window.addEventListener('load', function() {
        Echo.channel('listing-'+<?=$listing->id?>).listen('NewOfferSubmitted', e => {
            var notifications = document.getElementById('offers-notifications-wrapper');
            // notifications.innerHTML += '<div x-ref="noti'+e.offer.id+'" x-data="{ open: true }" x-show="open" x-transition:enter="transition transform duration-600" x-transition:enter-start="opacity-0 scale-40" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"><div class="bg-blue-50 bg-opacity-90 border-t-4 border-yellow-300 rounded-b text-teal-900 px-4 py-3 shadow-md mt-4"><div class="flex justify-between"><div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"></path></svg></div><div><p class="font-bold text-gray-600 pt-1">A New Bid was submitted</p><p class="text-sm">Someone made an offer of <b>'+format(e.offer.offer_amount)+' USD</b> for this Listing.</p></div><a class="cursor-pointer" @click="$refs.noti'+e.offer.id+'.remove()">x</a></div></div></div>';

            notifications.innerHTML += sprintf('@include("layouts.notification")', e.offer.id, e.offer.offer_amount, e.offer.id);

            // dispatch an event with Alpine.js is not working outside it's scope so the next dispatch may be a solution
            // $dispatch('set-current-bid', e.offer.offer_amount);

            /*** THIS IS HANDLED BY LIVEWIRE NOW ***/
            // this.dispatchEvent(new CustomEvent('set-current-bid', {detail: e.offer.offer_amount}));
            // document.getElementById('current_bid_suggestion').innerHTML = '$' + number_format(e.offer.offer_amount);
            // document.getElementById('current_bid_lbl').innerHTML = '$' + number_format(e.offer.offer_amount);
            // document.getElementById('current_bid').value = e.offer.offer_amount;
            // console.log(e);
        });
    });

    function sprintf(str) {
        var args = arguments, i = 1;

        return str.replace(/%(s|d|0\d+d)/g, function (x, type) {
            var value = args[i++];
            switch (type) {
            case 's': return value;
            case 'd': return parseInt(value, 10);
            default:
                value = String(parseInt(value, 10));
                var n = Number(type.slice(1, -1));
                return '0'.repeat(n).slice(value.length) + value;
            }
        });
    }

    function waitForImageToLoad(imageElement){
        return new Promise(resolve=>{imageElement.onload = resolve})
    }

    function switchImage(name) {
        image = document.getElementById('main-image');
        image_loader = document.getElementById('image-loader');
        image_loader.classList.remove("hidden");
        image.src = '/storage/listings/images/'+<?=$listing->id?>+'/original/'+name;
        waitForImageToLoad(image).then(()=>{
            image_loader.classList.add('hidden');
        });
    }

    function move(direction) {
        var element = document.getElementById('thumbnails');
        scrollAmount = 0;
        var slideTimer = setInterval(function(){
            if(direction == 'left'){
                element.scrollLeft -= 10;
            } else {
                element.scrollLeft += 10;
            }
            scrollAmount += 10;
            if(scrollAmount >= 200){
                window.clearInterval(slideTimer);
            }
        }, 25);
    }

    const number_format = num => String(num).replace(/(?<!\..*)(\d)(?=(?:\d{3})+(?:\.|$))/g, '$1,');

    function setTabs() {
        return {
            activeTab: 0,
            tabs: [
                "Overview",
                "Documents",
                "Due Diligence",
                "Buying Tips",
            ]
        };
    };
</script>
