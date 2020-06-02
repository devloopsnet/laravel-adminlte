<?php


namespace App\Traits;

use Illuminate\Notifications\RoutesNotifications;

/**
 * Trait Notifiable
 *
 * @package App\Traits
 * @date 2019-09-05
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait Notifiable
{
    use RoutesNotifications, HasDatabaseNotifications;
}
