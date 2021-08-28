<x-backend.layout>
    <div x-data="{
            open: 'general'
        }">
        <x-form action="/fitting-room/listing/2">
            @csrf()
            
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
            <div>
                <x-btn-modal type="button" @click="open = 'general'" x-bind:class="{'bg-blue-200': open == 'general'}">
                    General Info</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'info'" x-bind:class="{'bg-blue-200': open == 'info'}">
                    Listing Info</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'license'" x-bind:class="{'bg-blue-200': open == 'license'}">
                    Licensing</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'media'" x-bind:class="{'bg-blue-200': open == 'media'}">
                    Media</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'files'" x-bind:class="{'bg-blue-200': open == 'files'}">
                    Files</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'contacts'" x-bind:class="{'bg-blue-200': open == 'contacts'}">
                    Contacts</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'notes'" x-bind:class="{'bg-blue-200': open == 'notes'}">
                    Notes</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'bids'" x-bind:class="{'bg-blue-200': open == 'bids'}">
                    Auction Bids Placed</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'auction'" x-bind:class="{'bg-blue-200': open == 'auction'}">
                    Assigned Auction</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'offers'" x-bind:class="{'bg-blue-200': open == 'offers'}">
                    Listing Offers Placed</x-btn-modal>
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
                @include('backend.listing.section-notes')
            </div>
            <div x-show="open == 'auction'">
                @include('backend.listing.section-assigned-auction')
            </div>
            <div x-show="open == 'offers'">
                @include('backend.listing.section-offers-placed')
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