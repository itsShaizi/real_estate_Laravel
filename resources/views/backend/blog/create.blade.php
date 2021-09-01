<x-backend.layout>
    <div x-data="{ open: false,create: '{{ empty($blog->id) ? __('global.create') :__('global.edit') }}' }">
        <x-form action="{{ !empty($blog->id) ?route('bk-blog-update',$blog->id) :route('bk-blog-store')  }}" method="{{ !empty($blog->id) ?'PUT' : 'POST' }}">
            
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold"><span x-text="create"></span> Blog Post</h1>
                </div>
                <div>
                    <x-btn-modal class="bg-green-100" ><span x-text="create"></span> Post</x-btn-modal>
                    <x-button-href class="bg-red-200" href='{{ route("bk-blogs") }}'>Back</x-button-href>
                </div>
            </header>
            

            <x-backend.blog.form :blog="$blog"></x-backend.blog.form>
                
        </x-form>
    </div>

    
    @push('styles')
        @once
            <link rel="stylesheet" href="{{ asset('css/tom-select/tom-select.min.css') }}" />
        @endonce
    @endpush
    @push('scripts')
        @once
            <script src="{{ asset('js/tom-select/tom-select.min.js') }}"></script>
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

                    document.onreadystatechange = function () {
                        var TomSelect = null;
                        if (document.readyState == "interactive") {
                            initiTomSelect();
                        }
                    }
                    function initiTomSelect(){
                        TomSelect =  new TomSelect('#blog_post_tags',{
                            valueField: 'id',
                            labelField: 'content',
                            searchField: 'content',
                            create: true,
                            onItemAdd: function(){
                                TomSelect.setTextboxValue('');
                                TomSelect.clearOptions();
                            },
                            // fetch remote data
                            load: function(query, callback) {

                                var url = "{{ route('bk-tag-search') }}?search_term=" + encodeURIComponent(query);
                                const fetch_options = {
                                    method: 'GET',
                                    headers: { 
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                }
                                fetch(url,fetch_options)
                                    .then(response => response.json())
                                    .then(json => {
                                        callback(json);
                                    }).catch(()=>{
                                        callback();
                                    });

                            },
                            // custom rendering functions for options and items
                            render: {
                                option: function(item, escape) {
                                    return `<div class="py-2 d-flex">
                                                <div class="mb-1">
                                                    <span class="h4">
                                                        ${ escape(item.content) }
                                                    </span>
                                                </div>
                                            </div>`;
                                    
                                },
                                item: function(item, escape) {
                                    return `<div class="py-2 d-flex">
                                                <div class="mb-1">
                                                    <span class="h4">
                                                        ${ escape(item.content) }
                                                    </span>
                                                </div>
                                            </div>`;
                                }
                            },
                        });
                    }

                   
        </script>
    @endpush
    
</x-backend.layout>