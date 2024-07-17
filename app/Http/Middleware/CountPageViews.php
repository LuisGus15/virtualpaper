<?php

// app/Http/Middleware/CountPageViews.php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;

class CountPageViews
{
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        if ($routeName) {
            $pageView = PageView::firstOrCreate(['route_name' => $routeName]);
            $pageView->increment('views');
        }
        return $next($request);
    }
}






