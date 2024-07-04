<?php

namespace Modules\Accounts\Http\Controllers\Api;

use App\Helpers\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Http\Requests\ProfileRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, ApiTrait;


    /**
     * Show the specified resource.
     */
    public function show(): JsonResponse
    {
        /**
         * @var Account
         */
        $user = auth()->user();

        if (!$user) {
            return $this->sendError(trans('accounts::auth.failed'));
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function update(ProfileRequest $request): JsonResponse
    {
        /**
         * @var Account
         */
        $user = auth()->user();

        if (!$user) {
            return $this->sendError(trans('accounts::auth.failed'));
        }

        $user->update($request->all());

        if ($request->avatar && $request->avatar != null) {
            $user->addMediaFromBase64($request->avatar)
                ->usingFileName('avatar.png')
                ->toMediaCollection('avatars');
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * Check if the authenticated user exists.
     *
     * @return JsonResponse
     */
    public function exist(): JsonResponse
    {
        /**
         * @var Account
         */
        $user = auth()->user();

        if (!$user->exists()) {
            return $this->sendError(trans('accounts::auth.failed'));
        }

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function preferredLocale(Request $request): JsonResponse
    {
        /**
         * @var Account
         */
        $user = auth()->user();

        $user->preferred_locale = $request->preferred_locale;

        $user->push();

        $data = $user->getResource();
        return $this->sendResponse($data, 'success');
    }

    /**
     * Signs out the user.
     *
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        /**
         * @var Account
         */
        $user = auth()->user();
        //remove device token
        $user->update([
            'device_token' => null
        ]);

        $user->tokens()->delete();
        return $this->sendSuccess('you Have Signed Out Successfully');
    }

    /**
     * Check if the authenticated user exists.
     *
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        $user = auth()->user();

        if (!$user) {
            return $this->sendError('false');
        } else {
            return $this->sendSuccess('true');
        }
    }
}
