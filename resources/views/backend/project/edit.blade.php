<x-backend.layout>
    <div x-data="{
            open: 'general'
        }">
        <x-form action="{{ route('bk-project-update', $project->id) }}">
            
            <input type="hidden" name="id" value="{{$project->id}}">
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Update Project</h1>
                </div>
                <div>
                    <x-button>Save Project</x-button>
                </div>
            </header>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            @if ($message = Session::get('success'))
                <x-message :message="$message"/>
            @endif
            <div>
                <x-btn-modal type="button" @click="open = 'general'" x-bind:class="{'bg-blue-200': open == 'general'}">
                    General Info</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'media'" x-bind:class="{'bg-blue-200': open == 'media'}">
                    Media</x-btn-modal>
                <x-btn-modal type="button" @click="open = 'listings'" x-bind:class="{'bg-blue-200': open == 'listings'}">
                    Listings</x-btn-modal>    
            </div>

             <!-- General Info -->
            <div x-show="open == 'general'">
                @include('backend.project.section-general-info')
            </div>
            
            <div x-show="open == 'media'">
                @include('backend.project.section-media')
            </div>

            <div x-show="open == 'listings'">
                @include('backend.project.section-listings')
            </div>
                
        </x-form>

        <x-backend.section title="Danger Zone">

            <x-backend.delete-model
                label="Delete Project"
                route="{{ route('bk-project-delete', $project) }}"
                submitLabel="Delete Project"
                triggerButton="Delete Project"
                modalTitle="Delete Project"
                formId="{{ 'delete-project-'.$project->id }}"
            >
                <x-slot name="description">Once you delete this project, there is no going back. Please be certain.</x-slot>
                <x-slot name="modalDescription">This action cannot be undone. This will permanently delete the project.</x-slot>
            </x-backend.delete-model>

        </x-backend.section>

    </div>

</x-backend.layout>




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

function projectListings() {
    return {
        project_id: <?=$project->id?>,
        query: '',
        show_results: false,
        query_results: [],
        project_listings: [],
        async search() {
            this.query_results = [];
            let response = await fetch('/api/listings/search/'+this.query);
            let data = await response.json();
            this.query_results = data;
            if(this.query_results.length > 0) this.show_results = true;
            else this.show_results = false;
        },
        addListing(listing) {
            this.show_results = false;
            if (_.findIndex(this.project_listings, { 'id': listing.id }) === -1) {
                this.project_listings.push(listing);
            } 
            fetch('/agent-room/project/'+this.project_id+'/listing/'+listing.id+'/add', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
        },
        removeListing(listing) {
            this.project_listings = this.project_listings.filter(function( obj ) {
                return obj.id !== listing.id;
            });
            fetch('/agent-room/project/'+this.project_id+'/listing/'+listing.id+'/remove', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });
        },
        async loadListings() {
            let response = await fetch('/agent-room/project/'+this.project_id+'/listings');
            let data = await response.json();
            this.project_listings = data;
        }
    }
}

</script>