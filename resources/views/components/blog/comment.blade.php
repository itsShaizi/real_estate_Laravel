<div class="bg-gray-50 px-4 py-6 sm:px-6" >
    @if(!empty($comment))
        <div class="text-center" >
            Reply to <b>{{ $comment->name }}</b>
            <div class="float-right">
                <button type="button" class="text-gray-500 font-small" @click="document.querySelector( '#comment_input' ).classList.remove('hidden');reply_input_{{ $comment->id }} = false"> Close reply </button>
            </div>
        </div>
    @else
        <div class="text-center" >Want to join the discussion? <br>Feel free to contribute!</div>
    @endif
    <div class="flex space-x-3">
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGjqeuUmIgRcJJSKf9Oyvw-i6VRj3Nq5LZpvyhH7czkcNJ7YwJRflvel5onEPrwa-h49E&usqp=CAU" alt="" />
        </div>
        <div class="min-w-0 flex-1">
            <form action="{{ url('comment/store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                @if(!empty($comment->id))
                    <input type="hidden" name="comment_id" value="{{ $comment->id}}">
                @endif
                <div class="pt-2">
                    <label for="comment" class="sr-only">About</label>
                    <textarea required id="comment" name="comment" rows="3" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 sm:text-sm border border-gray-300 rounded-md p-2" placeholder="Add a comment"></textarea>
                </div>
                <div class="pt-2">
                    <label for="name" class="sr-only">Name</label>
                    <input required id="name" type="text" name="name" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md p-2" placeholder="Name">
                </div>
                <div class="pt-2">
                    <label for="email" class="sr-only">Email</label>
                    <input required id="email" type="email" name="email" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md p-2" placeholder="Email">
                </div>
                <div class="pt-2">
                    <label for="website" class="sr-only">Website</label>
                    <input id="website" type="texy" name="website" class="shadow-sm block w-full focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md p-2" placeholder="Website">
                </div>
                <div class="mt-3 flex items-center justify-between">

                    <button type="submit" class=" inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        @if(!empty($comment))
                            Reply
                        @else
                            Comment
                        @endif

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
