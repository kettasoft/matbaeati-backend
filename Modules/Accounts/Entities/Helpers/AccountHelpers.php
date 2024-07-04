<?php

namespace Modules\Accounts\Entities\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Modules\Accounts\Entities\ResetPasswordCode;
use Modules\Accounts\Entities\Account;
use Modules\Accounts\Entities\Verification;
use Modules\Accounts\Events\VerificationCreated;

trait AccountHelpers
{
    /**
     * Determine whether the account type is admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type === Account::ADMIN_TYPE;
    }

    /**
     * Determine whether the account type is office.
     *
     * @return bool
     */
    public function isOffice()
    {
        return $this->type === Account::OFFICE_TYPE;
    }

    /**
     * Determine whether the account type is printing prees.
     *
     * @return bool
     */
    public function isPrintingPress()
    {
        return $this->type === Account::PRINTING_PRESS_TYPE;
    }

    /**
     * Set the user type.
     *
     * @return $this
     */
    public function setType($type)
    {
        if (in_array($type, array_keys(trans('accounts::users.types')))) {
            $this->forceFill([
                'type' => $type,
            ])->save();
        }

        return $this;
    }

    /**
     * Set the user status.
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->forceFill([
            'status' => $status,
        ])->save();

        return $this;
    }

    /**
     * Set the user type.
     *
     * @return $this
     */
    public function setVerified(): self
    {
        $this->forceFill([
            'email_verified_at' => Carbon::now(),
            'phone_verified_at' => Carbon::now(),
        ])->save();

        return $this;
    }

    /**
     * Set the user email as a veridied.
     *
     * @return $this
     */
    public function setEmailVerified(): self
    {
        $this->forceFill([
            'email_verified_at' => Carbon::now(),
        ])->save();

        return $this;
    }

    /**
     * Determine whether the user can access dashboard.
     *
     * @return bool
     */
    public function canAccessDashboard()
    {
        return $this->isAdmin() || $this->isPrintingPress() || $this->isOffice();
    }

    /**
     * The user profile image url.
     *
     * @return bool
     */
    public function getAvatar()
    {
        return $this->getFirstMediaUrl('avatars');
    }

    /**
     * @return User
     */
    public function block()
    {
        return $this->forceFill(['blocked_at' => Carbon::now()]);
    }

    /**
     * @return User
     */
    public function unblock()
    {
        return $this->forceFill(['blocked_at' => null]);
    }

    /**
     * @return User
     */
    public function isBlocked()
    {
        return $this->blocked_at? true : false;
    }

    /**
     * @return User
     */
    public function isUnblocked()
    {
        return $this->blocked_at? false : true;
    }

    /**
     * @return User
     */
    public function isEmailVerified()
    {
        return $this->email_verified_at? true : false;
    }

    /**
     * @return User
     */
    public function isPhoneVerified()
    {
        return $this->phone_verified_at? true : false;
    }

    /**
     * @return User
     */
    public function approve()
    {
        return $this->forceFill(['status' => Account::APPROVED_STATUS]);
    }

    /**
     * Chack the user is approved
     *
     * @return boolean
     */
    public function isApproved(): bool
    {
        return $this->status == Account::APPROVED_STATUS;
    }

    /**
     * send verification sms to user
     * @param $phone
     * @param $code
     */
    public function sendSmsVerificationNotification($phone, $code): void
    {
        $greetings = trans('accounts::auth.register.verification.greeting', [
            'user' => $this->name,
        ]);
        $line = trans('accounts::auth.register.verification.line', [
            'code' => $code,
        ]);
        $footer = trans('accounts::auth.register.verification.footer');
        $salutation = trans('accounts::auth.register.verification.salutation', [
            'app' => Config::get('app.name'),
        ]);
        $site = config('accounts.sms_site');
        $api_key = config('accounts.sms_api_key');
        $title = config('accounts.sms_title');
        $text = $greetings . ' ' . $line . ' ' . $footer . ' ' . $salutation;
        $sentto = $phone;
        $report = 1;
        $sms_lang = 2;
        $local = app()->getLocale();
        if ($local === 'tr') {
            $sms_lang = 1;
        } elseif ($local === 'en') {
            $sms_lang = 0;
        }
        $body = array("api_key" => $api_key, "title" => $title, "text" => $text, "sentto" => $sentto, "report" => $report, "sms_lang" => $sms_lang);
        $json = json_encode($body);
        $ch = curl_init($site);
        $header = array('Content-Type: application/json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * send reset password sms
     * @param $code
     */
    public function sendSmsResetPasswordNotification($code): void
    {
        $greetings = trans('accounts::auth.emails.forget-password.greeting', [
            'user' => $this->name,
        ]);
        $line = trans('accounts::auth.emails.forget-password.line', [
            'code' => $code,
            'minutes' => ResetPasswordCode::EXPIRE_DURATION / 60,
        ]);
        $footer = trans('accounts::auth.emails.forget-password.footer');
        $salutation = trans('accounts::auth.emails.forget-password.salutation', [
            'app' => Config::get('app.name'),
        ]);
        $site = config('accounts.sms_site');
        $api_key = config('accounts.sms_api_key');
        $title = config('accounts.sms_title');
        $text = $greetings . $line . $footer . $salutation;
        $sentto = $this->phone;
        $report = 1;
        $sms_lang = 2;
        $local = app()->getLocale();
        if ($local === 'tr') {
            $sms_lang = 1;
        } elseif ($local === 'en') {
            $sms_lang = 0;
        }
        $body = array("api_key" => $api_key, "title" => $title, "text" => $text, "sentto" => $sentto, "report" => $report, "sms_lang" => $sms_lang);
        $json = json_encode($body);
        $ch = curl_init($site);
        $header = array('Content-Type: application/json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Send the phone number verification code.
     *
     * @param null $test_mode
     * @return void
     * @throws ValidationException
     */
    public function sendVerificationCode($test_mode = null): void
    {
        if (!$this || $this->email_verified_at) {
            throw ValidationException::withMessages([
                'phone' => [trans('accounts::verification.verified')],
            ]);
        }

        $verification = Verification::updateOrCreate([
            'user_id' => $this->id,
            'using' => $this->email
        ], [
            'token' => sha1(random_int(1111, 9999)),
            'using' => $this->email
        ]);

        if ($test_mode != 1 || !$test_mode) {
            // event(new VerificationCreated($verification));
        }
    }

    public function createVerificationEmailToken(): Verification
    {
        $verification =  $this->verify()->create([
            'token' => sha1(str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT)),
            'using' => $this->email
        ]);

        // event(new VerificationCreated($verification));

        return $verification;
    }
}
