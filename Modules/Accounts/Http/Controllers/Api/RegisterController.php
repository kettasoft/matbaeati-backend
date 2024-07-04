<?php

namespace Modules\Accounts\Http\Controllers\Api;

use App\Helpers\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Events\Registered;
use Modules\Accounts\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RegisterController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;
    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(RegisterRequest $request) //: JsonResponse
    {
        $account = Account::create($request->validatedWithHashedPassword());

        event(new Registered($account));

        return $this->sendResponse($account->getResource(), 'success', Response::HTTP_CREATED);
    }
}
