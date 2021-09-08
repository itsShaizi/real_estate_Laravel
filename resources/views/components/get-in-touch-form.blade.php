<div x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
    <!-- Trigger for Modal -->
    <div class="flex flex-col md:flex-row py-16 md:w-1/2 md:mx-auto justify-center font-bold">
        <button type="button" @click="showModal = true" class="bg-white text-black font-bold border-2 border-blue-400 rounded-full hover:bg-blue-300 hover:text-white md:ml-4 my-2 py-4 px-4 mx-12 md:mx-0 md:w-full md:w-auto">GET STARTED</button>
        <button type="button" @click="showModal = true" class="bg-blue-400 text-white font-bold border-2 border-white rounded-full hover:bg-blue-300 hover:text-white md:ml-4 my-2 py-4 px-4 mx-12 md:w-full md:w-auto">List in the MLS for as low as $395!</button>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50"x-show="showModal">
        <!-- Modal inner -->
        <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
            @click.away="showModal = false"
            x-transition:enter="motion-safe:ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100">
            
            <!-- Title / Close-->
            <div class="flex items-center justify-between">
                <div class="text-2xl text-blue-400 font-bold px-4 py-2">
                        <h1>We will get in touch with you</h1>
                </div>
                <button type="button" class="z-50 cursor-pointer" @click="showModal = false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

<!-- must create a route for this and change 'register' -->

            <form method="POST" action="{{ route('register') }}" class="mt-8"> 
            @csrf

                <!-- First Name -->
                <div class="mt-4 mx-4">
                    <x-input class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="{{ __('First Name *') }}" />
                </div>

                <!-- Last Name -->
                <div class="mt-4 mx-4">
                    <x-input class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus placeholder="{{ __('Last Name *') }}" />
                </div>

                <!-- Email Address -->
                <div class="mt-4 mx-4">
                    <x-input class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="email" type="email" name="email" :value="old('email *')" required placeholder="{{ __('Email') }}" />
                </div>

                <!-- Phone Number -->
                <div class="mt-4 mx-4">
                    <x-input class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="phone_number" type="number" name="phone_number" required placeholder="{{ __('Phone Number *') }}"/>
                </div>

                <!-- Message -->
                <div class="mt-4 mx-4">
                    <x-textarea class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="message" type="text" name="message" rows="6" required placeholder="{{ __('Tell us about your property *') }}"/>
                </div>

                <x-button class="flex mt-4 mx-auto justify-center w-min">
                    {{ __('Submit') }}  
                </x-button>
            </form>        
        </div>
    </div>
