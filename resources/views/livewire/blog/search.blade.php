<div >
    <div class="flex justify-between">
        <div class="w-full md:w-4/5">
            <x-input type="text" placeholder="Search by blog title" wire:model.debounce.500ms="search_term"></x-input>
        </div>
       
    </div>
    <!-- blog Table -->

    <x-backend.blog.table>
        @foreach($blogs as $i => $blog)
            <x-backend.blog.table-tr class="{{ $i % 2 ?: 'bg-blue-50' }}" :blog="$blog">
            </x-backend.blog.table-tr>
        @endforeach
    </x-backend.blog.table>
    <div class="flex flex-col justify-center">
        {!! $blogs->links() !!}
    </div>
</div>




