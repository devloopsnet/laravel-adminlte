<?php

namespace App\Models;

use App\Traits\TranslatableTitleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SystemNotification
 *
 * @property int id
 * @property string title
 * @property string body
 * @property int admin_id
 * @property Admin admin
 * @property string send_to_drivers
 * @property string send_to_users
 *
 * @package App\Models
 * @date 2019-07-16
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class SystemNotification extends Model
{
    use SoftDeletes, TranslatableTitleTrait;

    /**
     * @var array
     */
    protected $fillable = ['admin_id', 'title', 'body', 'send_to_drivers', 'send_to_users'];

    /**
     * @var array
     */
    protected $hidden = ['send_to_drivers', 'send_to_users'];

    /**
     * @var array
     */
    protected $with = ['admin'];

    /**
     * Define admin relation method
     *
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class)->withTrashed();
    }

}
