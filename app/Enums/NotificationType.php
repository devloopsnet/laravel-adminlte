<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class NotificationType
 *
 * @package App\Enums
 * @date 2019-07-12
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class NotificationType extends Enum
{
    public const DRIVER_RATING = 1995;
    public const ORDER_STATUS_UPDATE = 1994;
    public const NEW_ORDER = 1993;
    public const ORDER_ASSIGNED = 1992;
    public const SYSTEM_NOTIFICATION = 1991;
}
