<?php


namespace App\Traits;


use App\Models\Notification;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasDatabaseNotifications
 **
 * @package App\Traits
 * @date 2019-09-05
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait HasDatabaseNotifications
{
    /**
     * Get the entity's notifications.
     *
     * @return MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's read notifications.
     *
     * @return Builder
     */
    public function readNotifications(): Builder
    {
        return $this->notifications()->whereNotNull('read_at');
    }

    /**
     * Get the entity's unread notifications.
     *
     * @return Builder
     */
    public function unreadNotifications(): Builder
    {
        return $this->notifications()->whereNull('read_at');
    }
}
