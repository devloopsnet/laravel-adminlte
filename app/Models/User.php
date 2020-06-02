<?php

namespace App\Models;

use App\Traits\Notifiable;
use App\Traits\HasAvatarTrait;
use Cklmercer\ModelSettings\HasSettings;
use AvtoDev\FirebaseNotificationsChannel\Receivers\FcmDeviceReceiver;
use AvtoDev\FirebaseNotificationsChannel\Receivers\FcmNotificationReceiverInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class User
 *
 * @property int id
 * @property string full_name
 * @property string first_name
 * @property string last_name
 * @property string phone_number
 * @property string email
 * @property string password
 * @property string firebase_token
 * @property string gender
 * @property string locale
 * @property Notification[]|Collection notifications
 * @property int status
 * @property int wallet
 * @property int points
 * @property \App\Models\UserAddress[]|Collection user_addresses
 *
 * @method static Builder|self applySearch()
 * @method static Builder|self withPhoneNumber(string $phone_number)
 * @method static Builder|self withFacebookId(string $fbId)
 *
 * @package App\Models
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class User extends Authenticatable implements HasMedia {

  use HasApiTokens;
  use HasAvatarTrait;
  use HasMediaTrait;
  use HasSettings;
  use Notifiable;
  use SoftDeletes;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'fb_id',
    'first_name',
    'last_name',
    'phone_number',
    'gender',
    'email',
    'password',
    'status',
    'wallet',
    'points',
    'firebase_token',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'media',
    'otp',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Dates columns
   *
   * @var array
   */
  protected $dates = [
    'last_login',
    'updated_at',
    'created_at',
  ];

  /**
   * @var array
   */
  protected $appends = [
    'avatar_url',
    'full_name',
  ];

  /**
   * Define orders relation attribute
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function orders(): HasMany {
    return $this->hasMany(Order::class);
  }

  /**
   * Define user_addresses relation attribute
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function user_addresses(): HasMany {
    return $this->hasMany(UserAddress::class);
  }

  /**
   * Define user_credit_cards relation attribute
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function user_credit_cards(): HasMany {
    return $this->hasMany(UserCreditCard::class);
  }

  /**
   * Define full_name attribute
   *
   * @return string
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getFullNameAttribute(): string {
    return sprintf('%s %s', $this->first_name, $this->last_name);
  }

  /**
   * Find the user instance for the given phone_number.
   *
   * @param string $phoneNumber
   *
   * @return User|Builder|Model|object
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function findForPassport(string $phoneNumber): ?User {
    return self::query()->where('phone_number', $phoneNumber)->first();
  }

  /**
   * Receiver of firebase notification.
   *
   * @return FcmNotificationReceiverInterface
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function routeNotificationForFcm(): FcmNotificationReceiverInterface {
    return new FcmDeviceReceiver($this->firebase_token);
  }

  /**
   * return if user is blocked
   *
   * @return bool
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function isBlocked(): bool {
    return (int) $this->status === 2;
  }

  /**
   * return if user is inactive
   *
   * @return bool
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function isActive(): bool {
    return (int) $this->status === 1;
  }

  /**
   * return if user is inactive
   *
   * @return bool
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function isInactive(): bool {
    return (int) $this->status === 0;
  }

  /**
   * Define applySearch() scope
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   *
   * @return \Illuminate\Database\Eloquent\Builder
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function scopeApplySearch(Builder $builder): Builder {
    $req = request()->get('search') ?? [];

    if (isset($req['name']) && trim(rtrim($req['name'])) !== '') {
      $req['name'] = trim(rtrim($req['name']));
      $builder->whereRaw(sprintf("UPPER(CONCAT_WS(' ',`first_name`,`last_name`)) LIKE UPPER('%%%s%%')", $req['name']));
    }

    if (isset($req['phone_number']) && trim(rtrim($req['phone_number'])) !== '') {
      $builder->where('phone_number', 'LIKE', sprintf('%%%s%%', $req['phone_number']));
    }

    if (isset($req['email']) && trim(rtrim($req['email'])) !== '') {
      $builder->where('email', '=', $req['email']);
    }
    return $builder;
  }

  /**
   * Define withPhoneNumber() scope
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   * @param string $phoneNumber
   *
   * @return \Illuminate\Database\Eloquent\Builder
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function scopeWithPhoneNumber(Builder $builder, string $phoneNumber): Builder {
    return $builder->where('phone_number', '=', $phoneNumber);
  }

  /**
   * Define withFacebookId() scope
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   * @param string $fbId
   *
   * @return \Illuminate\Database\Eloquent\Builder
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function scopeWithFacebookId(Builder $builder, string $fbId): Builder {
    return $builder->where('fb_id', '=', $fbId);
  }

  /**
   * Cache user OTP for later validation
   *
   * @param string $otp
   *
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function saveOtp(string $otp) {
    Cache::put($this->id . '_otp_code', $otp, now()->addHour());
  }

  /**
   * Get Cached OTP
   *
   * @return string|null
   * @author Abdullah Al-Faqeir <abdullah@devloops.net>
   */
  public function getOtp(): ?string {
    return Cache::get($this->id . '_otp_code', NULL);
  }

}
