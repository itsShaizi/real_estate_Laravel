<input type="hidden" id="current_bid" value="{{ $listing->offers->max('offer_amount') }}" />

<!-- If the user isn't logged in, Catch the Event dispatched from the Login Modal login-modal.blade.php -->
<div x-data="offerForm()"
@logged-in.document="loggedIn($event.detail)"
class="border h-auto p-5 rounded-2xl text-gray-600"
>
	<div class="border-b pb-2 text-right text-xs">
		<div>{{ $event_type }}</div>
		<div>{{ $event_date }}</div>
        @if(!empty($auction))
            <x-frontend.listing.auction-countdown :auction="$auction">
            </x-frontend.listing.auction-countdown>
        @endif
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between">
            <div>List Price:</div>
            <div>${{ number_format($listing->list_price) }}</div>
        </div>
        <div class="flex justify-between">
            <div>Highest Bid:</div>
            <div id="current_bid_lbl" x-model="current_bid" x-text="'$'+number_format(current_bid)"></div>
        </div>
    </div>
    <div>
        <a @click="show_previous_bids = ! show_previous_bids" class="cursor-pointer text-sm hover:text-blue-600">Toggle previous bids</a>
        <div x-ref="offerlist" class="max-h-36 overflow-y-scroll" x-show="show_previous_bids" x-cloak>
            <div>
                <template x-for="[i, offer] of Object.entries(offers)">
                    <div class="flex justify-between w-full text-sm text-center border"
                        :class="i % 2 ? 'bg-gray-100' : 'bg-green-100' ">
                        <div
                            x-text="offer['created_at'].replace(/T/,' ').replace(/^[0-9]{4}\-/, '').replace(/\.[0-9a-z]+/i, '')">
                        </div>
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
        <x-frontend.listing.bid-btn />
        <x-frontend.listing.message />
    </form>
    <div class="text-sm mb-4">
        This event is now live! Don't miss out on your chance to own this great opportunity. Bid now to secure your
        offer.
    </div>
    <div class="text-sm text-blue-300 pointer">
        Wondering how the event process works with RealtyHive.com? Click here.
    </div>
    <template x-if="on">
        <x-alert title="Something Went Wrong">
            <div x-text="alert_message"></div>
        </x-alert>
    </template>
    <x-login-modal />
</div>

<!-- Catch the Event dispatched from the EventListener ('load') from listing.blade.php -->
<div x-data="offerForm()" @set-current-bid.window="formData.current_bid = $event.detail"></div>

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
        buttonLabel: 'Bid now!',
        current_bid: parseInt('<?=!empty(@$listing->offers->max('offer_amount')) ? $listing->offers->max('offer_amount') : 0;?>'.replace(',','')),
        offers: JSON.parse('<?=$listing->offers->sortByDesc('created_at')?>'),
        show_previous_bids: false,
        on: false,
        alert_message: '',
        login: false,
        csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        submitData() {

            if(! this.formData.user_id) {
                // Open Login Modal Event - Listened from within the component
                const event = new Event('open-login');
                document.dispatchEvent(event);
                return false;
            }
            if(this.formData.offer_type == 'auction') {
                console.log('current value:', document.getElementById('current_bid').value);
                if(parseInt(this.formData.offer_amount.replace(',','')) <= document.getElementById('current_bid').value) {
                    this.on = true;
                    this.alert_message = 'Your offer must be higher than the current highest offer';
                    return false;
                }
                if(!(this.formData.offer_amount.replace(',','') > 0)) {
                    this.on = true;
                    this.alert_message = 'Place an offer first';
                    return false;
                }
            }

            this.loading = true;
            this.buttonLabel = 'Submitting...';
            this.message = '';

            fetch('/offer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : this.csrf_token,
                    'X-Socket-Id': Echo.socketId()
                },
                body: JSON.stringify(this.formData)
            })
            .then((res) => {
                if(res.status == 201){
                    this.message_show = true;
                    this.message = 'Offer submitted successfully!';
                    this.message_details = 'One of our Agents will get in touch with you very soon.';
                    //this.offers.push = res;
                    document.getElementById('current_bid_suggestion').innerHTML = '$' + number_format(this.formData.offer_amount);
                    document.getElementById('current_bid_lbl').innerHTML = '$' + number_format(this.formData.offer_amount);
                    document.getElementById('current_bid').value = parseInt(this.formData.offer_amount);
                    this.current_bid = parseInt(this.formData.offer_amount.replace(',',''));
                    //$refs.current_bid.innerText = '$' + format(this.formData.offer_amount);
                    return console.log(res);
                } else {
                    this.on = true;
                    this.alert_message = 'Please check your offer and place it again, or try again later.';
                }
            })
            .catch(() => {
                this.message = 'Ooops! Something went wrong!'
            })
            .finally(() => {
                this.loading = false;
                this.buttonLabel = 'Bid now!'
            })
        },
        loggedIn(data){
            this.formData.user_id = data.user_id;
            this.csrf_token = data.csrf_token;
            this.submitData();
        }
    }
}
</script>
