<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempBlogCoverPhotoUploaderController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('blog_cover_photo')) {
            $request->validate([
                'blog_cover_photo' => 'required|image|max:2048'
            ]);

            return $request->file('blog_cover_photo')->store('blog_cover_photo', 'tmp');
        }
    }
}
