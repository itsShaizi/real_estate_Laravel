<div
    x-data="offerForm()"
    @logged-in.document="loggedIn($event.detail)"
    class="border h-auto p-5 rounded-2xl text-gray-600"
>
    <div class="border-b pb-2 text-right text-xs">
        <div>{{ $event_type }}</div>
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between"><div>List Price:</div><div>{{ $listing_price }}</div></div>
    </div>
    <form action="" method="POST" @submit.prevent="submitData">
        <div class="flex items-center justify-between py-5">
            <div class="w-1/2">My Best Offer:</div>
            <div class="w-1/2">
                <x-input x-model="formData.offer_amount"></x-input>
            </div>
        </div>
        <x-frontend.listing.bid-btn />
        <x-frontend.listing.message />
    </form>
    <div class="text-sm mb-4">
        By placing an offer, you are agreeing to the terms & conditions of the traditional sales process.
    </div>
    <div class="text-sm text-blue-300">
        Wondering how the traditional sales process works? Click here.
    </div>
    <template x-if="on">
        <x-alert title="Something Went Wrong"><div x-text="alert_message"></div></x-alert>
    </template>
    <x-login-modal />
</div>

<script type="text/javascript">
    function offerForm() {
        return {
            formData: {
                user_id: <?=$user_id?>,
                listing_id: <?=$listing_id?>,
                offer_amount: '',
                auction_id: <?=@$auction_id ? $auction_id : 'undefined'?>,
                offer_type: '<?=$offer_type?>',
                _token: '',
            },
            message: '',
            message_details: '',
            message_show: false,
            loading: false,
            buttonLabel: 'Place offer',
            csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            on: false,
            alert_message: '',
            submitData() {
                if(! this.formData.user_id) {
                    const event = new Event('open-login');
                    document.dispatchEvent(event);
                    return false;
                }
                if(!(this.formData.offer_amount.replace(',','') > 0)) {
                    this.on = true;
                    this.alert_message = 'You must place your offer first.';
                    return false;
                }
                this.buttonLabel = 'Submitting...';
                this.loading = true;
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
                        console.log(res.json());
                    }else{
                        this.on = true;
                        this.alert_message = 'Please check your offer and place it again, or try again later.';
                    }
                })
                .catch(() => {
                    this.message = 'Ooops! Something went wrong!'
                })
                .finally(() => {
                    this.loading = false;
                    this.buttonLabel = 'Place offer'
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

