<div class="p-3 mb-5 bg-yellow-400 bg-opacity-90 rounded-lg flex justify-between" x-show="message_show" x-transition:enter="transition transform duration-500" x-transition:enter-start="opacity-0 scale-40" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="flex flex-col">
        <p x-text="message" class="text-lg"></p>
        <p x-text="message_details" class="text-xs"></p>
    </div>
    <a @click="message_show = false" class="cursor-pointer">x</a>
</div>
