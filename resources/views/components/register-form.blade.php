<form method="POST" action="{{ route('register') }}" class="mt-8">
    @csrf

    <!-- First Name -->
    <div>
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="{{ __('First Name') }}" />
    </div>

    <!-- Last Name -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus placeholder="{{ __('Last Name') }}" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="email" type="email" name="email" :value="old('email')" required placeholder="{{ __('Email') }}" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="password" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="password_confirmation" type="password" name="password_confirmation" required placeholder="{{ __('Confirm Password') }}"/>
    </div>

    <x-select class="rounded-full w-full px-4 py-2 mt-4" name="country">
        <option value="">Select a Country...</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </x-select>

    <!-- Phone Number -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="phone_number" type="number" name="phone_number" required placeholder="{{ __('Phone Number') }}"/>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4 w-full">
            {{ __('Register') }}
        </x-button>
    </div>
</form>