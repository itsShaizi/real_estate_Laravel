{{-- This Modal must be opened by an Event called 'open-login' --}}
{{-- If the credentials are correct, it will dispatch an event with the user_id --}}

<div x-data="loginModalData()" @keyup.escape.window="if(on == true){ on = ! on }" @open-login.document="on = ! on">
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
                <h1 class="text-5xl text-realty font-bold text-center uppercase">{{ __('Log in') }}</h1>
                <x-flash-error @login-failed.document="show=true; setTimeout(() => show = false, 3000); ">
                    <ul class=" list-disc list-inside text-sm text-red-600">
                        <li>{{ __('Invalid credentials') }}</li>
                    </ul>
                </x-flash-error>
                <form method="POST" @submit.prevent="login" class="mt-8 w-full">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input
                        x-model="userLogin.email"
                        id="email"
                        type="email"
                        name="email"
                        class="rounded-full px-4 py-2 border-2 border-blue-400 w-full"
                        required autofocus placeholder="{{ __('Email') }}" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input
                        x-model="userLogin.password"
                        type="password"
                        name="password"
                        class="rounded-full px-4 py-2 border-2 border-blue-400 w-full" id="password"
                        required autocomplete="current-password" placeholder="{{ __('Password') }}" />
                    </div>

                    <div>
                        <x-button class="mt-4 w-full">
                            {{ __('Log in') }}
                        </x-button>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex justify-center">
                            <input
                                x-model="userLogin.remember"
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
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

                    <div class="mt-6">
                        <p class="pb-4"><strong>Not registered yet?</strong></p>
                        <a href="{{ route('register') }}"
                            class="active:bg-realty bg-realty border border-transparent disabled:opacity-25 duration-150 ease-in-out focus:border-gray-900 hover:bg-blue-600 items-center px-4 py-2 rounded-full text-white transition">
                            {{ __('Create Account') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

<script>
    function loginModalData() {
        return {
            on: false,
            userLogin: {
                    email: null,
                    password: null,
                    remember: null,
                    _token: ''
            },
            csrf_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            login() {
                fetch('/ajax-login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.csrf_token,
                        },
                    body: JSON.stringify(this.userLogin)
                }).then((response) => {
                    if(response.status == 201){
                        return response.json();
                    } else {
                        const event = new Event('login-failed');
                        document.dispatchEvent(event);
                        this.userLogin.password = null;
                        return false;
                    }
                }).then((data) => {
                    if(data.user_id) {
                        this.on = ! this.on;
                        const event = new CustomEvent('logged-in', { detail: data });
                        document.dispatchEvent(event);
                        document.querySelector('input[name="_token"]').setAttribute("value", data.csrf_token);
                        Livewire.emit('loggedIn');
                    }
                    return false;
                });
            }
        }
    }
</script>
