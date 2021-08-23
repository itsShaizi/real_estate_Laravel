<x-backend.section title="Media">
    <x-alert-message />
    <div class="">
        <div>
            <x-filepond
                name="media"
                uploadUrl="{{ route('bk-listing-upload-media', $listing->id) }}"
                grid-style
                allow-multiple-uploads
                max-parallel-uploads="2"
                max-files-uploads="8"
                file-size-validation="4MB"
                file-type-validation="image/*"
                clear-after-upload
            />
        </div>
        <livewire:listings.fetch-images :listing='$listing' />
    </div>
</x-backend.section>
