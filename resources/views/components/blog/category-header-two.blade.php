

<div class="bg-gray-100 py-8 px-36 -mt-4">

    <div class="container px-4 md:px-0 max-w-6xl mx-auto">

        <ul role="list" class="mt-3 w-11/12 mx-auto grid grid-cols-1 gap-3 sm:gap-4 sm:grid-cols-2 lg:grid-cols-5">

            <li data-id="latestbuz" x-bind:class="{ 'text-indigo-600 ': selected === 'option-0' }" class="col-span-1 flex tablinks">
                <div class="flex-1 flex items-center justify-between rounded-r-md truncate">
                    <div class="flex-1 py-2 text-sm truncate">
                        <a href="#latest-buz" class="hover:text-gray-600" x-on:click="selected = 'option-0'">LATEST BUZZ</a>
                    </div>
                </div>
            </li>

            @if(!empty($categories))

                @foreach ($categories as $key2  => $category)

                    <li  x-bind:class="{ 'text-indigo-600 ': selected === 'option-{{$key2+1}}' }" class="col-span-1 flex tablinks">
                        <div class="flex-1 flex items-center justify-between rounded-r-md truncate">
                            <div class="flex-1 py-2 text-sm truncate">
                                <a href="#{{Str::slug($category->name)}}" class="hover:text-gray-600" x-on:click="selected = 'option-{{$key2+1}}'">{{$category->name}}</a>
                            </div>
                        </div>
                    </li>

                @endforeach
            @endif

        </ul>
    </div>
</div>
