<x-backend.section title="Blog Post">
    <div>
        <div class="mb-5">
            <div>
                <x-label>{{ __('global.blog.title') }}</x-label>
                <x-input name="title" value="{{ old('title')?? $blog->title ?? '' }}"></x-input>
                <x-input-error for="title" />
            </div>
        </div>
        <div class="mb-5">
            <div>
                <x-label>{{ __('global.blog.content') }}</x-label>
                <textarea name="content" id="content" rows="10">
                    {!!  old('content')?? $blog->content ?? ''  !!}
                </textarea>
                <x-input-error for="content" />
            </div>
        </div>
        <div class="mb-5">
            <x-label>{{ __('global.tag.tags') }}</x-label>
            <select name="tags[]" id="blog_post_tags"  placeholder="add some tags" multiple>
                @if(!empty($blog->tags->count()))
                    @foreach($blog->tags as $tag)
                        <option selected>
                            {{ trim($tag->content) }}
                        </option>
                    @endforeach
                @endif
            </select>
            <x-input-error for="tags" />
        </div>
        <div class="mb-5">
            <x-label>{{ __('global.category') }}</x-label>
            <select name="category" id="blog_category"  placeholder="add Category" required>
                @if(!empty($blog->category))
                    <option selected>
                        {{ trim($blog->category->name) }}
                    </option>
                @endif
            </select>
            <x-input-error for="tags" />
        </div>
        <div class="mb-5">
            <x-label>{{ __('global.blog.cover_photo') }}</x-label>
            <div
                    x-data="{edit: false}"
                    x-init="() => {
                        @if (!$blog->cover_image)
                            edit = true
                        @endif
                    }"
                    class="p-2 flex lg:flex-col items-start"
                >
                    @if ($blog->cover_image)
                        <div x-show="!edit" class="relative">
                            <x-button-warning
                                type="button"
                                x-on:click="edit = true"
                                class="absolute cursor-pointer right-0 bottom-0 opacity-50 hover:opacity-100"
                            >
                                <x-icons.pencil />
                            </x-button-warning>
                            <img
                                src="{{ url('/storage/blogs/images/' . $blog->id . '/original/' .$blog->cover_image->title )}}"
                                class="w-auto object-cover"
                            >
                        </div>
                    @endif
                    <div x-show="edit" class="w-full">
                        <x-filepond
                            class="w-auto"
                            name="blog_cover_photo"
                            uploadUrl="{{ url('api/temp-blog-cover-photo-uploader') }}"
                            file-size-validation="2MB"
                            file-type-validation="image/*"
                            correct-image-orientation
                            crop-aspect-ratio="1:1"
                        />
                    </div>
                </div>
        </div>
    </div>
</x-backend.section>