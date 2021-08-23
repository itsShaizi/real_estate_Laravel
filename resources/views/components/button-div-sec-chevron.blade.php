@props([
    'click' => '',
    'chevron' => false
])

<div class="relative border-2 border-blue-300 hover:border-blue-400 rounded-full p-2 px-4 cursor-pointer mr-2'" @click="{{$click}}"> {{ $slot }} <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': {{$chevron}}, 'rotate-0': !{{$chevron}}}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></div>