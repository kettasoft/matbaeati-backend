<?php

namespace Modules\Accounts\Entities;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Modules\Accounts\Entities\Admin;
use Modules\Accounts\Entities\Office;
use Laratrust\Contracts\LaratrustUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laratrust\Traits\HasRolesAndPermissions;
use Modules\Accounts\Entities\PrintingPress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Accounts\Transformers\AccountResource;
use Modules\Accounts\Entities\Helpers\AccountHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Accounts\Database\factories\AccountFactory;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Modules\Accounts\Entities\Relations\AccountRelations;
use Modules\Accounts\Notifications\EmailVerificationNotification;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

/**
 * Account class
 * @property \Modules\Quotations\Entities\Quotation $quotation
 * @property \Modules\Subscriptions\Entities\Subscription $subscription
 * @property \Modules\Accounts\Entities\Verification $verification
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property bool $status
 * @property string $type
 * @property string $password
 * @property string $remember_token
 * @property string $device_token
 * @property string $preferred_locale
 * @property \Carbon\Carbon $blocked_at
 * @property \Carbon\Carbon $last_login_at
 * @property \Carbon\Carbon $email_verified_at
 * @property \Carbon\Carbon $phone_verified_at
 */
class Account extends Authenticatable implements HasLocalePreference, LaratrustUser, HasMedia
{
    use HasFactory,
        HasApiTokens,
        HasChildren,
        HasRolesAndPermissions,
        Notifiable,
        AccountRelations,
        AccountHelpers,
        HasUploader,
        PresentableTrait,
        InteractsWithMedia,
        Filterable;

    /**
     * The code of printing press type.
     *
     * @var string
     */
    public const PRINTING_PRESS_TYPE = 'printing-press';

    /**
     * The code of office type.
     *
     * @var string
     */
    public const OFFICE_TYPE = 'office';

    /**
     * The code of office type.
     *
     * @var string
     */
    public const ADMIN_TYPE = 'admin';

    /**
     * The code of pending status.
     *
     * @var int
     */
    public const PENDING_STATUS = '0';

    /**
     * The code of pending status.
     *
     * @var int
     */
    public const APPROVED_STATUS = '1';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'password',
        'remember_token',
        'blocked_at',
        'last_login_at',
        'device_token',
        'preferred_locale',
        'email_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'blocked_at',
        'last_login_at',
        'email_verified_at'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * @var array
     */
    protected array $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::OFFICE_TYPE => Office::class,
        self::PRINTING_PRESS_TYPE => PrintingPress::class,
    ];

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale(): string
    {
        return $this->preferred_locale ?? app()->getLocale();
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(50)
                    ->format('png');

                $this->addMediaConversion('small')
                    ->width(120)
                    ->format('png');

                $this->addMediaConversion('medium')
                    ->width(160)
                    ->format('png');

                $this->addMediaConversion('large')
                    ->width(320)
                    ->format('png');
            });
    }

    /**
     * Get the resource for account type.
     *
     * @return AccountResource
     */
    public function getResource()
    {
        return new AccountResource($this);
    }

    /**
     * Get the access token currently associated with the user. Create a new.
     *
     * @param string|null $device
     * @return string
     */
    public function createTokenForDevice($device = null): string
    {
        $device = $device ?: 'Unknown Device';

        if ($this->currentAccessToken()) {
            return $this->currentAccessToken()->token;
        }

        $this->tokens()->where('name', $device)->delete();

        return $this->createToken($device)->plainTextToken;
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification($this->verification->code));
    }

    public function routeNotificationForOneSignal()
    {
        return $this->device_token;
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return '#';
    }
}
