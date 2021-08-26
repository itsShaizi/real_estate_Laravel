<div
x-data="{ show: false }"
x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 transform scale-90"
x-transition:enter-end="opacity-100 transform scale-100"
x-transition:leave="transition ease-in duration-300"
x-transition:leave-start="opacity-100 transform scale-100"
x-transition:leave-end="opacity-0 transform scale-90"
@login-failed.document="
    show=true;
    setTimeout(() => show = false, 3000);
">
    <div class="font-medium text-red-600 mt-3">
        {{ __('Whoops! Something went wrong.') }}
    </div>
    {{ $slot }}
</div>
