<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->filled('locale') && Arr::exists(config('localization.available_locales'), $request->locale)) {
            session(['locale' => $request->locale]);
        }

        if ($request->filled('currency') && Arr::exists(config('localization.available_currencies'), $request->currency)) {
            session(['currency' => $request->currency]);
        }

        if ($request->filled('meassure') && Arr::exists(config('localization.available_meassures'), $request->meassure)) {
            session(['meassure' => $request->meassure]);
        }

        return redirect()->back();
    }
}
