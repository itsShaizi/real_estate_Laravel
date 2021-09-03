<x-backend.layout>
    <div>
        <div x-data="{ open: 'general' }">

            <header class="flex justify-between items-center">
                <h1 class="text-3xl font-bold">Update User</h1>
                <div x-show="open != 'general'" class="hidden md:flex"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90">
                    <x-backend.avatar-name :path="$user->avatar" :name="$user->first_name . ' ' . $user->last_name">
                        <x-slot name="altName">
                            {{ $user->first_name .' '. $user->last_name }}<br>
                            {{ $user->email }}
                        </x-slot>
                    </x-backend.avatar-name>
                </div>
            </header>

            <div class="flex my-3 overflow-x-auto">
                <x-button-tab type="button" tab="general" />
                <x-button-tab type="button" tab="phones" />
                <x-button-tab type="button" tab="emails" />
                <x-button-tab type="button" tab="addresses" />
                <x-button-tab type="button" tab="licenses" />
            </div>

            <hr />

            <div x-show="open == 'general'" class="mt-4">
                @include('backend.user.general')
            </div>

            <div x-show="open == 'phones'" class="mt-4">
                <livewire:phones-section :user="$user" :countries="$countries" />
            </div>

            <div x-show="open == 'emails'" class="mt-4">
                <livewire:email-section :user="$user" />
            </div>

            <div x-show="open == 'addresses'" class="mt-4">
                <livewire:addresses-section :user="$user" :countries="$countries"  />
            </div>

            <div x-show="open == 'licenses'" class="mt-4">
                <livewire:licenses-section :user="$user" :countries="$countries"  />
            </div>

        </div>
    </div>
</x-backend.layout>
