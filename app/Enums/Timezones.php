<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class Timezones
 *
 * @package App\Enums
 * @date 11/24/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Timezones extends Enum {

    /**
     * Return list of all timezones
     *
     * @return array
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public static function getTimezones(): array {
        return \DateTimeZone::listIdentifiers();
    }

}
