<div class="border h-auto p-5 rounded-2xl text-gray-600">
    <div class="border-b pb-2 text-right text-xs">
        <div>
            Traditional Sale
        </div>
    </div>
    <div class="py-2 text-base">
        <div class="flex justify-between">
            <div>
                List Price:
            </div>
            <div>
                {{ price($list_price) }}
            </div>
        </div>
    </div>
    <form wire:submit.prevent="submit">
        <div class="flex items-center justify-between pt-5">
            <div class="w-1/2">
                My Best Offer:
            </div>
            <div class="w-1/2">
                <x-input wire:model.defer="offer_amount"></x-input>
            </div>
        </div>
        <div class="mb-7 mt-2">
            <x-button
                wire:loading.attr="disabled"
                class="flex justify-center w-full active:bg-blue-9700 bg-blue-600 hover:bg-blue-400 focus:border-blue-700 disabled:opacity-80"
            >
                <span wire:loading.remove>Place offer</span>
                <x-icons.animated-spin wire:loading />
                <span wire:loading>Submitting...</span>
            </x-button>
        </div>
        <div
            x-data="{ message_show : false, message : null, message_details : null }"
            x-init="
                document.addEventListener('show-message', event => {
                    message = event.detail.message;
                    message_details = event.detail.message_details;
                    message_show = true;
                });
            "
        >
            <x-frontend.listing.message />
        </div>
    </form>
    <div class="text-sm">
        By placing an offer, you are agreeing to the terms & conditions of the traditional sales process.
    </div>
    <div class="text-sm mt-4 text-blue-300 pointer">
        Wondering how the event process works with RealtyHive.com? Click here.
    </div>
    <div
        x-data="{ on : false, alert_message : null }"
        x-init="
            document.addEventListener('alert-message', event => {
                alert_message = event.detail.alert_message;
                on = true;
            });
        "
    >
        <x-alert title="Something Went Wrong">
            <div x-text="alert_message"></div>
        </x-alert>
    </div>
</div>
