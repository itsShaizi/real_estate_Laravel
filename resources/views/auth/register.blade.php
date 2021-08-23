<x-app-layout>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
        <div class="flex justify-center bg-blue-500 bg-opacity-75">
            <div class="w-full md:w-1/2 mt-36 p-20 rounded-xl bg-white text-center shadow-lg -mb-8">
                <h class="text-5xl text-realty font-bold text-center">CREATE ACCOUNT</h>
                <x-register-form :countries="$countries"></x-register-form>
            </div>
        </div>

</x-app-layout>

