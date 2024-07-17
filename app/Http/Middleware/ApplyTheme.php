<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Theme;

class ApplyTheme
{
    public function handle($request, Closure $next)
    {
        $themeName = session('theme', 'Adulto'); 
        $theme = Theme::where('name', $themeName)->first();

        if ($theme) {
            View::share('theme', $theme);
        }

        return $next($request);
    }
}
