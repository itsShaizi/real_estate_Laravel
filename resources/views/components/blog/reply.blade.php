<li class="mt-0">
    <div class="flex space-x-3 pl-2">
        <div class="flex-shrink-0">
            <img
                class="h-10 w-10 rounded-full"
                src="{{  url(($reply->auther()) && (count($reply->auther()->images)>0) ? '/storage/users/images/' . $reply->auther()->id . '/thumb/' .$reply->auther()->images->last()->title : 'https://e7.pngegg.com/pngimages/182/371/png-clipart-user-profile-login-computer-icons-avatar-avatar-child-face-thumbnail.png') }}"
        </div>
        <div>
            <div class="text-sm">
                <a href="#" class="font-medium text-gray-900">{{ $reply->name }}</a>
            </div>
            <div class="mt-1 text-sm text-gray-700">
                <p class="w-full">
                    {{ $reply->comment }}
                </p>
            </div>
            <div class="mt-2 text-sm space-x-2">
            <span class="text-gray-500 font-medium"
            >{{ $reply->created_at }}</span>

            </div>
        </div>
    </div>
</li>
