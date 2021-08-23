
<form method="POST" action="{{ route('login') }}" class="mt-8">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="{{ __('Email') }}" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="password" type="password" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" />
    </div>

    <div>
        <x-button class="mt-4 w-full">
            {{ __('Log in') }}
        </x-button>
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex justify-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex justify-center mt-2">
        @if (Route::has('password.request'))
            <a class="text-sm text-realty hover:text-blue-600" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </div>

    <div class="mt-20">
        <p class="pb-4"><strong>Not registered yet?</strong></p>
        <a href="{{ route('register') }}" class="active:bg-realty bg-realty border border-transparent disabled:opacity-25 duration-150 ease-in-out focus:border-gray-900 hover:bg-blue-600 items-center px-4 py-2 rounded-full text-white transition">
            {{ __('Create Account') }}
        </a>
    </div>
</form>