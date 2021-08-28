<div class="relative mt-2 appearance-none border border-gray-300 w-full py-2 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent flex-1" x-data="multiselectComponent()" x-init="$watch('selected', value => selectedString = value.join(','))">

    <span class="fa fa-chevron-down absolute top-0 right-3 mt-3 text-gray-500" aria-hidden="true"></span>

    <input
           x-model="selectedString"
           type="text" id="msa-input"
           aria-hidden="true"
           x-bind:aria-expanded="listActive.toString()"
           aria-haspopup="tag-list"
           hidden>

    <input type="hidden" name="{{ $name }}" x-bind:value="selectedValues()">

    <div class="flex flex-wrap space-x-2 space-y-1" @click="listActive = !listActive" @click.away="listActive = false" x-bind:class="{'active': listActive}">
        <span class="pl-4 cursor-default" x-show="selected.length == 0">{{ $placeholder }}</span>
        <template x-for="(tag, index) in selected">
            <x-badge>
                <span x-text="tag.name"></span>
                <button x-bind:data-index="index" @click.stop.prevent="removeMe($event)"><span class="fa fa-times" aria-hidden="true"></span></button>
            </x-badge>
        </template>
    </div>

    <ul id="tag-list" class="border border-gray-300 mt-2 absolute rounded-lg bg-white max-h-64 w-full overflow-auto" x-show.transition="listActive" role="listbox">
      <template x-for="(tag, index, collection) in unselected">
        <li class="hover:bg-realty hover:text-white cursor-pointer pl-4 py-2"
            x-show="!selected.includes(tag)"
            x-bind:value="tag"
            x-text="tag.name"
            aria-role="button"
            @click.stop="addMe($event)"
            x-bind:data-index="index"
            role="option"
         ></li>
      </template>
    </ul>

    <script>
        function multiselectComponent() {
            return {
                listActive: false,
                selectedString: '',
                selected: @json($selected),
                unselected: @json($unselected),
                addMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.unselected.splice(index, 1);
                    this.selected.push(extracted[0]);
                },
                removeMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.selected.splice(index, 1);
                    this.unselected.push(extracted[0]);
                },
                selectedValues(){
                    return this.selected.map((option)=>{
                        return option.id;
                    })
                },
            };
        }
    </script>
</div>
