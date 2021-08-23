<div>

    {{--
        The x-data needs to be runned on the top of the thumb carousel images,
        in order to change the selected image.
        x-data contains imgModal boolean, ative, count, and left / right methods@auth
        {imgModal : false, active : 0, count : {{ $listing->images->count() - 1 }}, left() { this.active = this.active
    === 0 ? this.count : this.active - 1 }, right() { this.active = this.active === this.count ? 0 : this.active + 1 }}
    --}}

    {{ $trigger }}

    <template @img-modal.window="imgModal = true;" x-if="imgModal">
        <div x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="imgModalSrc = ''"
            class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-gray-500 bg-opacity-75">

            {{-- Left Right BUttons % Close Button / Top Right Corner --}}
            <div @click="imgModal = ''"
                class="absolute top-6 right-6 text-white text-opacity-75 hover:text-opacity-100 cursor-pointer">
                <svg class="fill-current font-bold w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
            </div>
            <div class="absolute left-0 top-50 z-40 p-2 text-white text-opacity-75 hover:text-opacity-100 cursor-pointer"
                x-on:click="left()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="absolute right-0 top-50 z-40 p-2 text-white text-opacity-75 hover:text-opacity-100 cursor-pointer"
                x-on:click="right()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>

            @foreach($listing->images as $key => $image)
            <template x-if="active == {{ $key }}"
                @keyup.escape.window="imgModal = ''">
                <img
                x-transition:enter="transition delay-1 ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-50"
                x-transition:enter-end="opacity-100 transform scale-100"
                class="object-cover h-screen"
                src="/storage/listings/images/{{$listing->id}}/original/{{$image->title}}" loading="lazy">
            </template>
            @endforeach
        </div>
    </template>
</div>
