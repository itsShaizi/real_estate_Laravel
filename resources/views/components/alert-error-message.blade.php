@props([
    'message' => session('flash.banner'),
    'timer' => false,
])

<div
    x-data="{{ json_encode(['show' => true, 'message' => $message]) }}"
    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
    style="display: none;"
    x-show="show && message"
    x-init="
        document.addEventListener('alert-error-message', event => {
            message = event.detail.message;
            show = true;
        });"
    @if($timer)
    @alert-error-message.document="setTimeout(() => show = false, 3000)"
    @endif
    x-transition:enter="transform transition ease-in-out duration-300 opacity-0"
    x-transition:enter-start="-translate-y-full"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transform transition ease-in-out duration-300"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="-translate-y-full opacity-0"
>
    <strong class="font-bold">Whoops!</strong>
    <span class="block sm:inline" x-text="message"></span>
    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <title>Close</title>
            <path
                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
        </svg>
    </span>
</div>
