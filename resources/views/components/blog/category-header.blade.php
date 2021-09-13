<div class="container mx-auto py-6 border-b" style="max-width: 1310px;">
    <div class="flex justify-between">
        <a  href="{{ route('sd-category-wise-blogs',[
            'slug' => Str::slug($category->name),
            'id' => $category->id
        ]) }}" class="h2">Archive for category: {{ $category->name }}
        </a>
    </div>
</div>