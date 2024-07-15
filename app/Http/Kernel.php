<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // Otros middlewares...
            \App\Http\Middleware\CountPageViews::class,
            \App\Http\Middleware\SharePageViewCounts::class,
            
        ],
        // ...
    ];
    // ...
}
