<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use Illuminate\Support\Facades\View; // Asegúrate de importar esta clase

class SharePageViewCounts
{
    public function handle($request, Closure $next)
    {
        $pageViews = PageView::all();
        View::share('pageViews', $pageViews); // Usar View::share

        return $next($request);
    }
}
