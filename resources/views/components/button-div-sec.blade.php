@props([
    'click' => '',
])

<div class="relative border-2 border-blue-300 hover:border-blue-400 rounded-full p-2 px-4 cursor-pointer mr-2" @click="{{$click}}"> {{ $slot }} </div>
