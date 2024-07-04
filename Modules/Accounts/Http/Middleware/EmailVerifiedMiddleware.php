<?php

namespace Modules\Accounts\Http\Middleware;

use Closure;
use App\Helpers\ApiTrait;
use Illuminate\Http\Request;
use Modules\Accounts\Entities\Account;

class EmailVerifiedMiddleware
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
        $account = $request->user();

        if (!$account->email_verified_at) {
            return $this->sendError('Your email is not verified.', code: 401);
        }

        return $next($request);
    }
}
