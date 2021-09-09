<section aria-labelledby="notes-title">
    <div class="bg-white shadow sm:rounded-lg sm:overflow-hidden" x-data="{comment_input: true}">
        @if(!empty($blog->comments->count()))
            <div class="">
                <div class="px-4 py-5 sm:px-6">
                    <h2 id="notes-title" class="text-lg font-medium text-gray-900">
                        Comments
                    </h2>
                </div>
                <div class="px-4 py-6 sm:px-6">
                    <ul role="list" class="space-y-8">
                        @foreach($blog->comments as $comment)
                            @if(!empty($comment->comment_id))
                                @continue
                            @endif
                        <li x-data="{reply_input_{{ $comment->id }}: false}">
                            <div class="flex space-x-3">
                                <div class="flex-shrink-0">
                                    <img
                                        class="h-10 w-10 rounded-full"
                                        src="https://e7.pngegg.com/pngimages/182/371/png-clipart-user-profile-login-computer-icons-avatar-avatar-child-face-thumbnail.png" alt=""/>
                                </div>
                                <div>
                                    <div class="text-sm">
                                        <a href="#" class="font-medium text-gray-900">{{ $comment->name }}</a>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700">
                                        <p class="w-full">
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                    <div class="mt-2 text-sm space-x-2">
                                        <span class="text-gray-500 font-medium"
                                        >{{ $comment->created_at }}</span>
                                        <span class="text-gray-500 font-medium"
                                        >&middot;</span>
                                        <button type="button" class="text-gray-900 font-medium" @click="document.querySelector( '#comment_input' ).classList.add('hidden');reply_input_{{ $comment->id }} = true"> Reply </button>
                                    </div>
                                </div>
                            </div>
                            <div x-show="reply_input_{{ $comment->id }}">
                                <x-blog.comment :blog="$blog" :comment="$comment"></x-blog.comment>
                            </div>
                            @foreach($blog->comments as $reply)
                                @if(!empty($reply->comment_id) && $comment->id == $reply->comment_id)
                                    <x-blog.reply :reply="$reply"></x-blog.reply>
                                @endif
                            @endforeach
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        
        <div x-ref="comment_input" id="comment_input">
            <x-blog.comment :blog="$blog"></x-blog.comment>
        </div>
    </div>
</section>