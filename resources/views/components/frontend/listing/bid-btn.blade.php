<div class="mb-7 mt-2">
    <x-button x-bind:disabled="loading" class="flex justify-center w-full active:bg-blue-9700 bg-blue-600 hover:bg-blue-400 focus:border-blue-700 disabled:opacity-80">
        <template x-if="loading">
            <x-icons.animated-spin />
        </template>
        <span x-text="buttonLabel"></span>
    </x-button>
</div>
