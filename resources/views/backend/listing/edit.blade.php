<x-backend.layout>
    <div x-data="{
            open: 'general'
        }">
        <x-form action="{{ route('bk-listing-update', $listing->id) }}" method="PUT">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Edit Property Listing</h1>
                    <h2 class="text-2xl">Status: N/A</h2>
                    <h3>Number of views: 0</h3>
                </div>
                <div>
                    <x-btn-modal class="bg-green-100">Save Listing</x-btn-modal>
                    <x-btn-modal class="bg-red-200">Back</x-btn-modal>
                </div>
            </header>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            @if ($message = Session::get('success'))
                <x-message :message="$message"/>
            @endif
            <div class="flex overflow-x-auto">
                <x-button-tab type="button" tab="general" />
                <x-button-tab type="button" tab="info" />
                <x-button-tab type="button" tab="license" />
                <x-button-tab type="button" tab="media" />
                <x-button-tab type="button" tab="files" />
                <x-button-tab type="button" tab="contacts" />
                <x-button-tab type="button" tab="notes" />
                <x-button-tab type="button" tab="offers" />
                <x-button-tab type="button" tab="auction" />
            </div>

            <!-- General Info -->
            <div x-show="open == 'general'">
                @include('backend.listing.section-general-info')
            </div>
            <div x-show="open == 'info'">
                @include('backend.listing.section-listing-info')
            </div>
            <div x-show="open == 'license'">
                @include('backend.listing.section-license-info')
            </div>
            <div x-show="open == 'media'">
                @include('backend.listing.section-media')
            </div>
            <div x-show="open == 'files'">
                @include('backend.listing.section-files')
            </div>
            <div x-show="open == 'contacts'">
                <livewire:listings.contacts :listing="$listing" />
            </div>
            <div x-show="open == 'notes'">
                <livewire:listings.notes :listing="$listing" />
            </div>
            <div x-show="open == 'offers'">
                @include('backend.listing.section-offers')
            </div>
            <div x-show="open == 'auction'">
                @include('backend.listing.section-assigned-auction')
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
