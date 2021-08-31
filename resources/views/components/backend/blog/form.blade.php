<x-backend.section title="Blog Post">
    <div>
        <div class="mb-5">
            <div>
                <x-label>Title</x-label>
                <x-input name="title" value="{{ old('title') }}"></x-input>
                <x-input-error for="title" />
            </div>
        </div>
        <div class="mb-5">
            <div>
                <x-label>Content</x-label>
                <x-textarea name="content" value="{{ old('content') }}" id="content" rows="10"></x-textarea>
                <x-input-error for="content" />
            </div>
        </div>
        <div class="mb-5">
            <x-label>Tags</x-label>
            <x-input name="tags" value="{{ old('tags') }}"></x-input>
            <x-input-error for="tags" />
        </div>
        <div class="mb-5">
            <x-label>Cover Photo</x-label>
            <x-filepond
                class="w-40"
                name="blog_cover_photo"
                uploadUrl="{{ url('api/temp-blog-cover-photo-uploader') }}"
                file-size-validation="2MB"
                file-type-validation="image/*"
                correct-image-orientation
                crop-aspect-ratio="1:1"
            />
        </div>
    </div>
</x-backend.section>