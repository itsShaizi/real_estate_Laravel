<div class="border h-auto p-5 rounded-2xl text-gray-600">
    <div class="border-b pb-2 text-right text-xs">
        <div>{{ $event_type }}</div>
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between"><div>List Price:</div><div>${{ $listing_price }}</div></div>
    </div>
    <form action="" method="POST" x-data="offerForm()" @submit.prevent="submitData">
        <div class="flex items-center justify-between py-5">
            <div class="w-1/2">My Best Offer:</div>
            <div class="w-1/2">
                <x-input x-model="formData.offer_amount"></x-input>
            </div>
        </div>
        <div class="mb-7 mt-2">
            <x-button class="w-full active:bg-blue-9700 bg-blue-600 hover:bg-blue-400 focus:border-blue-700">
                Place offer
            </x-button>
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
        By placing an offer, you are agreeing to the terms & conditions of the traditional sales process.
    </div>
    <div class="text-sm text-blue-300">
        Wondering how the traditional sales process works? Click here.
    </div>
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
			buttonLabel: 'Submit',

            submitData() {
                this.buttonLabel = 'Submitting...'
                this.loading = true;
                this.message = '';
                if(! this.formData.user_id) {
                    alert('You must login to submitt an offer: '+this.formData.user_id);
                    return false    ;
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
			    	console.log(res.json());
			    })
				.catch(() => {
					this.message = 'Ooops! Something went wrong!'
				})
				.finally(() => {
					this.loading = false;
					this.buttonLabel = 'Submit'
				})
			}
		}
	}
	</script>	

