<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use League\Flysystem\Adapter\AbstractFtpAdapter;
use League\Flysystem\FilesystemInterface;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Admin
 *
 * @property int                             $id
 * @property string                          name
 * @property string                          email
 * @property string                          password
 * @property Carbon                          last_login
 * @property Carbon                          created_at
 * @property Carbon                          updated_at
 * @property Role[]|Collection               roles
 * @property SystemNotification[]|Collection system_notifications
 *
 * @package App\Models
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Admin extends Authenticatable {
    use HasRoles, Notifiable, SoftDeletes;

    /**
     * @var string
     */
    protected $guard_name = 'admin';

    /**
     * @var array
     */
    protected $dates = [ 'last_login', 'created_at', 'updated_at' ];

    /**
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'last_login' ];

    /**
     * Define system_notifications relation method
     *
     * @return HasMany
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function system_notifications(): HasMany {
        return $this->hasMany( SystemNotification::class );
    }

}
