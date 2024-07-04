<?php

namespace Modules\Accounts\Http\Controllers\Api;

use Carbon\Carbon;
use App\Helpers\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Accounts\Entities\Account;
use Illuminate\Database\Eloquent\Builder;
use Modules\Accounts\Http\Requests\LoginRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;

    /**
     * Display a listing of the resource.
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $account = Account::where(function (Builder $query) use ($request) {
            $query->where('email', $request->username);
            $query->orWhere('phone', $request->username);
        })->first();

        if (!$account) {
            return $this->sendError(trans('accounts::auth.failed'));
        }

        if ($account->blocked_at) {
            auth()->logout();
            return $this->sendError(trans('accounts::auth.blocked'));
        }

        if (!Hash::check($request->password, $account->password)) {
            return $this->sendError(trans('accounts::accounts.messages.password'));
        }

        event(new Login('sanctum', $account, false));

        $account->last_login_at = Carbon::now()->toDateTimeString();
        $account->preferred_locale = $request->preferred_locale ?? app()->getLocale();

        if ($account->device_token === null || $account->device_token != $request->device_token) {
            $account->device_token = $request->device_token;
        }

        $account->push();

        $data = $account->getResource();

        return $this->sendResponse($data, 'success');
    }
}
