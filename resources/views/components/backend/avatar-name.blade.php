@props([
    'path' => null,
    'name' => 'No Image',
    'altName' => false
])

<div class="flex flex-col md:flex-row items-center space-x-4">
    <div class="flex-shrink-0">
        <img class="h-10 w-10 rounded-full object-cover" src="{{ $path ?? 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF' }}" alt="">
    </div>
    @if($altName)
    <div class="whitespace-nowrap">{{ $altName }}</div>
    @else
    <div class="whitespace-nowrap">{{ $name }}</div>
    @endif
</div>
