<!-- categories -->
<div class="space-y-1">
    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider" id="projects-headline"> Categories
    </h3>
    <div class="space-y-1" role="group" aria-labelledby="projects-headline" >
        @if(!empty($categories))
            @foreach ($categories as $category)
                <a href="{{ route('sd-category-wise-blogs',
                [
                    'slug' => Str::slug($category->name),'id' => $category->id
                ])
                }}" class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                    <span class="truncate"> {{ $category->name }} </span>
                </a>    
            @endforeach
        @endif
    </div>
</div>