{{-- This Modal must be opened by an Event called 'open-contact' --}}
{{-- If the credentials are correct, it will dispatch an event with the user_id --}}

<div x-data="contactForm()" @keyup.escape.window="if(on == true){ on = ! on }" @open-contact-us.document="on = ! on">
    <template x-if="on">
        <div x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-gray-500 bg-opacity-75">
            <div class="relative flex flex-col bg-white rounded-xl border border-gray-300 w-full max-w-2xl p-4 sm:p-10">
                <div @click="on = ! on" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 cursor-pointer">
                    <x-icons.close />
                </div>
                <h1 class="text-5xl text-realty font-bold text-center">{{ __('Contact Us') }}</h1>
                <form method="POST" @submit.prevent="send" class="mt-8 w-full">
                    @csrf

                    <!-- First Name -->
                    <div>
                        <x-input
                        x-model="client.first_name"
                        id="first_name"
                        type="text"
                        name="first_name"
                        class="rounded-xl px-4 py-2 border-2 border-blue-400 w-full"
                        required autofocus placeholder="{{ __('First Name') }} *" />
                    </div>

                    <!-- Last Name -->
                    <div class="mt-4">
                        <x-input
                        x-model="client.last_name"
                        id="last_name"
                        type="text"
                        name="last_name"
                        class="rounded-xl px-4 py-2 border-2 border-blue-400 w-full"
                        required placeholder="{{ __('Last Name') }} *" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input
                        x-model="client.email"
                        id="email"
                        type="email"
                        name="email"
                        class="rounded-xl px-4 py-2 border-2 border-blue-400 w-full"
                        required placeholder="{{ __('Email') }} *" />
                    </div>

                    <!-- Message -->
                    <div class="mt-4">
                        <x-textarea
                        x-model="client.message"
                        type="text"
                        name="message"
                        class="rounded-xl px-4 py-2 border-2 border-blue-400 w-full" id="message"
                        required placeholder="{{ __('Message') }} *" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button-div-sec click="on = ! on">
                            {{ __('Close') }}
                        </x-button-div-sec>
                        <x-button>
                            {{ __('Submit') }}
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </template>
</div>

<script>
    function contactForm() {
        return {
            on: false,
            client: {
                first_name: null,
                last_name: null,
                email: null,
                message: null,
                _token: ''
            },
            csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            send() {
                fetch('/contact-us', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf_token,
                        },
                    body: JSON.stringify(this.client)
                }).then((response) => {

                });
            }
        }
    }
</script>
