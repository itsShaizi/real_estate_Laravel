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
        {{ __('Submit') }}    </div>
    </x-button>

</form>