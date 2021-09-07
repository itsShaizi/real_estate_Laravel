<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            Config::set('localization.locale', session()->get('locale'));
        }

        if (session()->has('currency')) {
            Config::set('localization.currency', session()->get('currency'));
        }

        if (session()->has('meassure')) {
            Config::set('localization.meassure', session()->get('meassure'));
        }

        App::setLocale(config('localization.locale'));

        return $next($request);
    }
}
