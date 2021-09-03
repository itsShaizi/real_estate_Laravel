<form method="POST" action="{{ route('register') }}" class="mt-8">
    @csrf

    <div class="text-2xl text-blue-400 font-bold px-4 py-2">
        <h1>We will get in touch with you</h1>
    </div>

    <!-- First Name -->
    <div class="mt-4 mx-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="{{ __('First Name') }}" />
    </div>

    <!-- Last Name -->
    <div class="mt-4 mx-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus placeholder="{{ __('Last Name') }}" />
    </div>

    <!-- Email Address -->
    <div class="mt-4 mx-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="email" type="email" name="email" :value="old('email')" required placeholder="{{ __('Email') }}" />
    </div>

    <!-- Phone Number -->
    <div class="mt-4 mx-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="phone_number" type="number" name="phone_number" required placeholder="{{ __('Phone Number') }}"/>
    </div>

    <!-- Message -->
    <div class="mt-4 mx-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="message" type="text" name="message" required placeholder="{{ __('Message') }}"/>
    </div>

    <x-button class="flex mt-4 mx-auto justify-center w-min">
        {{ __('Submit') }}    </div>
    </x-button>

</form>