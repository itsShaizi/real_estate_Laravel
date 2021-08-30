<div>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Create Tag</h1>
        </div>
        @if($this->showUpdateForm)
            <div>
                <x-btn-modal class="bg-green-100" wire:click="update" wire:loading.attr="disabled" wire:target="update">Update Tag</x-btn-modal>
                <x-btn-modal class="bg-red-100" wire:click="resetValues">Cancel Update</x-btn-modal>
            </div>
        @else
            <div>
                <x-btn-modal class="bg-green-100" wire:click="save" wire:loading.attr="disabled" wire:target="save">Save Tag</x-btn-modal>
            </div>
        @endif
    </header>
    <hr/>
    <x-backend.section title="{{$this->showUpdateForm ? 'Update Tag Info' : 'Tag Info'}}" class="grid gap-4">
        <div>
            <x-label>Tag</x-label>
            <x-input wire:model="tag.content" name="tag_content"/>
            @error('tag.content')
            <span class="text-sm text-red-600">{{ $errors->first('tag.content') }}</span>
            @enderror
        </div>
    </x-backend.section>
    <div class="flex flex-col mt-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700 text-white text-left text-xs font-medium tracking-wider">
                        <tr>
                            <th scope="col" class="px-2 py-3">
                                Tag Label
                            </th>
                            <th scope="col" class="relative px-2 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($this->tags as $index => $tag)
                            <tr class="{{ $index % 2 ?: 'bg-blue-50' }} text-sm hover:bg-blue-200">
                                <td class="text-base px-2 py-2">{{ $tag->content }}</td>
                                <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{$tag}})" class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </button>
                                    /
                                    <button wire:click="delete({{$tag}})" class="text-indigo-600 hover:text-indigo-900">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
