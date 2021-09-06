<div class="bg-white flex justify-end">
    <div class="relative" x-data="{ open: false }">
        <div @mouseover="open = true" @mouseout="open = false">
            <div class="cursor-pointer py-2 px-4 rounded rounded-t-0 border border-b-1">
                {{ __('Preferences') }}
                <span class="ml-1 font-bold fas fa-angle-down"></span>
            </div>
            <div x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute z-50 w-max rounded-md shadow-lg origin-top-right right-0"
                    style="display: none;">
                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                    <form action="{{ route('localization') }}" method="POST">
                        @csrf
                        <div class="p-2">
                            <p>
                                {{ __('Language') }}
                            </p>
                            <div class="ml-4 mt-2 flex flex-col space-y-1">
                                @foreach (config('localization.available_locales') as $key => $locale)
                                    <label for="{{ $locale['title'] }}">
                                        <input type="radio" name="locale" id="{{ $locale['title'] }}" value="{{ $key }}" {{ (config('localization.locale') == $key) ? 'checked' : '' }}> 
                                        {{ __($locale['title']) }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-2">
                            <p>
                                {{ __('Currency') }}
                            </p>
                            <div class="ml-4 mt-2 flex flex-col space-y-1">
                                @foreach (config('localization.available_currencies') as $key => $currency)
                                    <label for="{{ $currency['title'] }}">
                                        <input type="radio" name="currency" id="{{ $currency['title'] }}" value="{{ $key }}" {{ (config('localization.currency') == $key) ? 'checked' : '' }}> 
                                        {{ __($currency['title']) }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-2">
                            <p>
                                {{ __('Meassures') }}
                            </p>
                            <div class="ml-4 mt-2 flex flex-col space-y-1">
                                @foreach (config('localization.available_meassures') as $key => $meassure)
                                    <label for="{{ $meassure['title'] }}">
                                        <input type="radio" name="meassure" id="{{ $meassure['title'] }}" value="{{ $key }}" {{ (config('localization.meassure') == $key) ? 'checked' : '' }}> 
                                        {{ __($meassure['title']) }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-2">
                            <x-button class="w-full">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>