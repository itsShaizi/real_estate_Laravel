<input type="hidden" id="current_bid" value="{{ $listing->offers->max('offer_amount') }}"/>
<div class="border h-auto p-5 rounded-2xl text-gray-600" x-data="offerForm()">
	<div class="border-b pb-2 text-right text-xs">
		<div>{{ $event_type }}</div>
		<div>{{ $event_date }}</div>
        @if(!empty($auction))
            <x-frontend.listing.auction-countdown :auction="$auction">
            </x-frontend.listing.auction-countdown>
        @endif
    </div>
    <div class="py-2 text-base">
	    <div class="flex justify-between"><div>List Price:</div><div>${{ number_format($listing->list_price) }}</div></div>
	    <div class="flex justify-between"><div>Highest Bid:</div><div id="current_bid_lbl" x-model="current_bid" x-text="'$'+number_format(current_bid)"></div></div>
    </div>
    <div>
        <a @click="show_previous_bids = ! show_previous_bids" class="cursor-pointer text-sm hover:text-blue-600">Toggle previous bids</a>
        <div x-ref="offerlist" class="max-h-36 overflow-y-scroll" x-show="show_previous_bids" x-cloak>
            <div>
                <template x-for="[i, offer] of Object.entries(offers)">
                    <div class="flex justify-between w-full text-sm text-center border" :class="i % 2 ? 'bg-gray-100' : 'bg-green-100' ">
                        <div x-text="offer['created_at'].replace(/T/,' ').replace(/^[0-9]{4}\-/, '').replace(/\.[0-9a-z]+/i, '')"></div>
                        <div x-text="number_format(offer['offer_amount']) + 'US$'"></div>
                    </div>
                </template>
            </div>
        </div>
    </div>
    <form action="" method="POST" @submit.prevent="submitData">
        <div class="flex items-center justify-between pt-5">
        	<div class="w-1/2">My Max Bid:</div>
        	<div class="w-1/2">
        		<x-input x-model="formData.offer_amount"></x-input>
    		</div>
        </div>
        <div class="text-xs text-right">
            <span>Enter <b id="current_bid_suggestion" x-text="'$'+number_format(current_bid)"></b> or more</span>
        </div>
        <div class="mb-7 mt-2">
        	<x-button class="w-full active:bg-blue-9700 bg-blue-600 hover:bg-blue-400 focus:border-blue-700">Bid now!</x-button>
        </div>
        <div class="p-3 mb-5 bg-yellow-400 bg-opacity-90 rounded-lg flex justify-between" x-show="message_show" x-transition:enter="transition transform duration-500" x-transition:enter-start="opacity-0 scale-40" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex flex-col">
                <p x-text="message" class="text-lg"></p>
                <p x-text="message_details" class="text-xs"></p>
            </div>
            <a @click="message_show = false" class="cursor-pointer">x</a>
        </div>
    </form>
    <div class="text-sm mb-4">
    	This event is now live! Don't miss out on your chance to own this great opportunity. Bid now to secure your offer.
    </div>
    <div class="text-sm text-blue-300 pointer">
        Wondering how the event process works with RealtyHive.com? Click here.
    </div>
    <x-alert title="Something Went Wrong" x-show="on"><div x-text="alert_message"></div></x-alert>
</div>	

<!-- Catch the Event dispatched from the EventListener ('load') from listing.blade.php -->
<div
    x-data="offerForm()"
    @set-current-bid.window="formData.current_bid = $event.detail"
>

<script type="text/javascript">
    function offerForm() {
        return {
            formData: {
                user_id: <?=$user_id?>,
                listing_id: <?=$listing->id?>,
                offer_amount: '',
                auction_id: <?=@$auction_id ? $auction_id : 'undefined'?>,
                offer_type: '<?=$offer_type?>',
                _token: '',
            },
            message: '',
            message_details: '',
            message_show: false,
            loading: false,
            buttonLabel: 'Submit',
            current_bid: parseInt('<?=!empty(@$listing->offers->max('offer_amount')) ? $listing->offers->max('offer_amount') : 0;?>'.replace(',','')),
            offers: JSON.parse('<?=$listing->offers->sortByDesc('created_at')?>'),
            show_previous_bids: false,
            on: false,
            alert_message: '',
            login: false,
            submitData() {
                this.buttonLabel = 'Submitting...'
                this.loading = true;
                this.message = '';
                if(! this.formData.user_id) {
                    this.on = true;
                    this.alert_message = 'You must login to submitt an offer';
                    return false;
                }
                if(this.formData.offer_type == 'auction') {
                    console.log('current value:', document.getElementById('current_bid').value);
                    if(parseInt(this.formData.offer_amount.replace(',','')) < document.getElementById('current_bid').value) {
                        this.on = true;
                        this.alert_message = 'Your offer must be higher then the current highest offer';
                        return false;
                    }
                }
                fetch('/offer', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Socket-Id': Echo.socketId()
                    },
                    body: JSON.stringify(this.formData)
                })
                .then((res) => {
                    this.message_show = true;
                    this.message = 'Offer submitted successfully!';
                    this.message_details = 'One of our Agents will get in touch with you very soon.';
                    //this.offers.push = res;
                    document.getElementById('current_bid_suggestion').innerHTML = '$' + number_format(this.formData.offer_amount);
                    document.getElementById('current_bid_lbl').innerHTML = '$' + number_format(this.formData.offer_amount);
                    document.getElementById('current_bid').value = parseInt(this.formData.offer_amount);
                    this.current_bid = parseInt(this.formData.offer_amount.replace(',',''));
                    //$refs.current_bid.innerText = '$' + format(this.formData.offer_amount);
                    console.log(res);
                })
                .catch(() => {
                    this.message = 'Ooops! Something went wrong!'
                })
                .finally(() => {
                    //
                    //this.loading = false;
                    //this.buttonLabel = 'Submit'
                })
            }
        }
    }
</script>
