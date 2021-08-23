<x-modal>
    
    <x-slot name="trigger">{{ $trigger ?? '' }}</x-slot>

    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" x-show.transition="on">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="w-full sm:flex sm:items-start">
                <div class="mt-3 text-center w-full sm:mt-0 sm:ml-4 sm:text-left ">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        {{ $title }}
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ $slot }}
                        </p>  
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="on = false"
                type="button" 
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                {{ $alertLabel ?? 'Ok' }}
            </button>
        </div>
    </div>

</x-modal>
