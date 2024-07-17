<?php

// app/Http/Kernel.php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
            // Otros middlewares...
            \App\Http\Middleware\CountPageViews::class,
            \App\Http\Middleware\SharePageViewCounts::class,
            \App\Http\Middleware\ApplyTheme::class,
        ],
        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        // Otros middlewares...
    ];
}

