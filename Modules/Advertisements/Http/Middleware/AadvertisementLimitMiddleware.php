<?php

namespace Modules\Advertisements\Http\Middleware;

use App\Helpers\ApiTrait;
use Closure;
use Illuminate\Http\Request;
use Modules\Accounts\Entities\Account;
use Modules\Advertisements\Entities\Advertisement;

class AadvertisementLimitMiddleware
{
    use ApiTrait;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var Account
         */
        $account = auth()->user();

        if ($account->advertisements()->count() >= Advertisement::MAX_ADVERTISEMENTS_COUNT) {
            return $this->sendUnauthorized();
        }

        return $next($request);
    }
}
