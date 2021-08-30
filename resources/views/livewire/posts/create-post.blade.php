<div>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Create Post</h1>
        </div>
    </header>
    <hr/>
    <x-backend.section title="Post Info">
        <div class="p-2">
            <x-label>Title</x-label>
            <x-input wire:model="post.title"/>
            @error('post.title')
            <span class="text-sm text-red-600">{{ $errors->first('post.title') }}</span>
            @enderror
        </div>
        
        <div class="p-2">
            <x-label>Tags</x-label>
            <x-multi-select placeholder="Select Tags" name="tags" :selected="$selectedTags" :unselected="$unselectedTags"/>
        </div>
        <div class="p-2">
            <x-label>Content</x-label>
            <div
                x-data
                x-init="editor()"
                wire:ignore
            >
                <textarea id="content" name="content"></textarea>
            </div>

        </div>
    </x-backend.section>
</div>


<script>
    function editor() {
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                console.log(editor);
                editor.model.document.on('change:data', () => {
                    console.log(editor.getData())
                @this.set('post.content', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    }

</script>
