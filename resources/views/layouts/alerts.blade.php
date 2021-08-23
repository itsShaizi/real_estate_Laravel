{{--
<x-alert 
    @open-alert.window="if ($event.detail.id == 1) on = true"
    @click.away="on = false">
    <x-slot name="title">Hey!</x-slot>
    <x-slot name="trigger">
            <button @click="on = true">Alert 1</button>
        </x-slot>
        What's up!
</x-alert>

<x-alert 
    @open-alert="if ($event.detail.id == 2) on = true"
    @click.away="on = false">
    <x-slot name="title">Should be RED!</x-slot>
    <x-slot name="trigger">
            <button @click="on = true">Alert 2</button>
        </x-slot>
    SAAAAA
</x-alert>

<x-alert 
    @open-alert.window="if ($event.detail.id == 3) on = true"
    @click.away="on = false">
    <x-slot name="title">GREEN Box!</x-slot>
    <x-slot name="trigger">
            <button @click="on = true">Alert 3</button>
        </x-slot>
    Saaaaaa
</x-alert> 
--}}