<x-app-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center bg-blue-500 bg-opacity-75">
        <div class="w-full md:w-1/2 mt-36 p-20 rounded-xl bg-white text-center shadow-lg -mb-8">
            <h1 class="text-5xl text-realty font-bold text-center">LOG IN</h1>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" class="text-left mt-4" />

            <x-login-form></x-login-form>
        </div>
    </div>

</x-app-layout>
