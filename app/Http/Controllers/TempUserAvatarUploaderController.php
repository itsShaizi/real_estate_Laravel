<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempUserAvatarUploaderController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('avatar')) {
            $request->validate([
                'avatar' => 'required|image|max:2048'
            ]);

            return $request->file('avatar')->store('avatars', 'tmp');
        }
    }
}
