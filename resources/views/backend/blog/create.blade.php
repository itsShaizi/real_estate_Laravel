<x-backend.layout>
    <div x-data="{ open: false }">
        <x-form action="{{ route('bk-blog-store') }}">
            
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Blog Post</h1>
                </div>
                <div>
                    <x-btn-modal class="bg-green-100">Save Post</x-btn-modal>
                    <x-button-href class="bg-red-200" href='{{ route("bk-blogs") }}'>Back</x-button-href>
                </div>
            </header>
            

            <x-backend.blog.form></x-backend.blog.form>
                
        </x-form>
    </div>

    
    @push('styles')
        @once
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        @endonce
    @endpush
    @push('scripts')
        @once
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @endonce
        <script>
            ClassicEditor
                    .create( document.querySelector( '#content' ) )
                    .then( editor => {
                            // console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
        </script>
    @endpush
    
</x-backend.layout>