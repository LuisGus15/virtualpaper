<?php
// app/Http/Middleware/SharePageViewCounts.php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use Illuminate\Support\Facades\View;

class SharePageViewCounts
{
    public function handle($request, Closure $next)
    {
        $pageViews = PageView::all();
        View::share('pageViews', $pageViews);
        return $next($request);
    }
}


