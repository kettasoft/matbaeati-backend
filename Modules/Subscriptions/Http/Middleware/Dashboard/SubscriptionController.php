<?php

namespace Modules\Subscriptions\Http\Middleware\Dashboard;

use Closure;
use Illuminate\Http\Request;

class SubscriptionController
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
