<x-backend.layout>
    <div x-data="{ open: false }">
        <x-form action="{{ route('bk-blog-store') }}">
            
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Blog Post</h1>
                </div>
                <div>
                    <x-btn-modal class="bg-green-100">Save Post</x-btn-modal>
                    <x-btn-modal class="bg-red-200">Back</x-btn-modal>
                </div>
            </header>
            

            <!-- General Info -->
            <x-backend.blog.form></x-backend.blog.form>
                
        </x-form>
    </div>

    <script>
            ClassicEditor
                    .create( document.querySelector( '#content' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>
</x-backend.layout>