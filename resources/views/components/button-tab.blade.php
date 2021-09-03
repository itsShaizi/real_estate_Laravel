<div x-show="open == '{{ $tab }}'" style="display: none;">
    <x-button class="mr-2" type="button" @click="open = '{{ $tab }}'" >{{ ucfirst($tab) }}</x-button>
</div>
<div x-show="open != '{{ $tab }}'" style="display: none;">
    <x-button-div-sec type="button" click="open = '{{ $tab }}'" >{{ ucfirst($tab) }}</x-button-div-sec>
</div>
