<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-auction-store') }}">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Auction</h1>
                </div>
                <div>
                    <x-button>Save Auction</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div>
                    <div class="md:flex md:justify-between text-sm">
                        <div class="p-2">
                            <x-label>
                                Auction Name <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-input name="name" value="{{ old('name') ?? '' }}"/>
                            <x-input-error for="name" />
                        </div>

                        <div class="p-2">
                            <x-label>
                                Start Date and Time <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-date-picker name="start_date" value="{{ old('start_date') ?? '' }}"></x-date-picker>
                            <x-input-error for="start_date" />
                            <x-time-picker name="start_time" value="{{ old('start_time') ?? '' }}"></x-time-picker>
                            <x-input-error for="start_time" />
                        </div>
                        <div class="p-2">
                            <x-label>
                                End Date and Time <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-date-picker name="end_date" value="{{ old('end_date') ?? '' }}"></x-date-picker>
                            <x-input-error for="end_date" />
                            <x-time-picker name="end_time" value="{{ old('end_time') ?? '' }}"></x-time-picker>
                            <x-input-error for="end_time" />
                        </div>
                        <div class="p-2 md:w-1/2">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea name="description" placeholder="Describe the Auction Event" value="{{ old('description') ?? '' }}"></x-textarea>
                            <x-input-error for="description" />
                        </div>
                    </div>
                    <hr class="my-4"/>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>

                        </div>
                    </div>
                </div>
            </x-backend.section>

        </x-form>
    </div>

</x-backend.layout>
