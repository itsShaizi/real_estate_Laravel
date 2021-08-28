<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempCompanyLogoUploaderController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->has('logo')) {
            $request->validate([
                'logo' => 'required|image|max:2048'
            ]);

            return $request->file('logo')->store('logos', 'tmp');
        }
    }
}
