<x-landing-layout>

    <div class="bg-center bg-rh-image-contact -mt-32">
        <div class="h-full bg-blue-500 bg-opacity-75">
            <div class="md:w-4/5 p-20 text-center mx-auto pt-40">
            <h1 class="text-white text-4xl md:text-7xl pb-2">Contact Us<span style="color:#FFD226">.</span></h1>    
            </div>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto justify-center">
        <div class="flex mb-32 mt-8">
            <div class="md:w-1/2">
                <div class="text-2xl text-blue-400 font-bold px-4 py-2">
                    <h1>Get in Touch</h1>
                </div>      
                <!-- need to chenge the route 'register'  -->         
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
                <!-- Message -->
                <div class="mt-4">
                    <x-textarea class="rounded-lg px-4 py-2 border-2 border-blue-400 w-full" id="message" type="text" name="message" rows="6" required placeholder="{{ __('Tell us about your property *') }}"/>
                </div>
                <!-- Submit -->
                <x-button class="flex mt-4 mx-auto justify-center w-min">
                    {{ __('Submit') }} 
                </x-button>
                </form>
            </div>

             <div class="md:w-1/2 h-auto pt-8 px-8">
                <x-map :lat="44.552986548830084" :long="-88.08576687983488" class="h-full w-auto rounded-2xl"></x-map>
            </div>
        </div>
    </div>

    <div class="container md:flex text-center max-w-7xl mx-auto">
        <div class="md:w-1/2 box bg-white shadow-lg rounded-2xl mx-4 my-16 relative shadow-2xl h-40">
            <h3 class="text-lg text-blue-400">General Inquiries</h3><br>
            <a href="tel:Phone: 888-239-1896">Phone: 888-662-1020</a><br>
            <a>Fax: 920-662-7500</a><br>
            <a href="mailto:email@realtyhive.com">email@realtyhive.com</a><br>
        </div>
        <div class="md:w-1/2 box bg-white shadow-lg rounded-2xl mx-4 my-16 relative shadow-2xl h-40">
            <h3 class="text-lg text-blue-400">Corporate Office </h3><br>
             <h3>RealtyHive, LLC<br/>445 Cardinal Lane, Suite 102<br/>Green Bay, WI 54313<br/><br/>
             </h3>
        </div>
    </div>
    
</x-landing-layout>