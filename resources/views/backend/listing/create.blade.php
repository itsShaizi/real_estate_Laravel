<x-backend.layout>
    <div x-data="{ open: false }">
        <x-form action="{{ route('bk-listing-store') }}">
            
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Property Listing</h1>
                    <h2 class="text-2xl">Status: N/A</h2>
                    <h3>Number of views: 0</h3>
                </div>
                <div>
                    <x-btn-modal class="bg-green-100">Save Listing</x-btn-modal>
                    <x-btn-modal class="bg-red-200">Back</x-btn-modal>
                </div>
            </header>
            <div>
                <x-btn-modal type="button" @click="open = false" x-bind:class="{'bg-blue-200': ! open}">
                    General Info</x-btn-modal>
                <x-btn-modal type="button" @click="open = true" x-bind:class="{'bg-blue-200': open}">
                    Listing Info</x-btn-modal>
            </div>

            <!-- General Info -->
            <div x-show="!open">
                @include('backend.listing.section-general-info')
            </div>
            <div x-show="open">
                @include('backend.listing.section-listing-info')
            </div>
                
        </x-form>
    </div>

    <script>
            ClassicEditor
                    .create( document.querySelector( '#editor1' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
            ClassicEditor
                    .create( document.querySelector( '#editor2' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
            ClassicEditor
                    .create( document.querySelector( '#editor3' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
            ClassicEditor
                    .create( document.querySelector( '#editor4' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
            ClassicEditor
                    .create( document.querySelector( '#editor5' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>
</x-backend.layout>