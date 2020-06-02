<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class Times
 *
 * @package App\Enums
 * @date 11/24/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Times extends Enum {

    private static $autoPlayTimes = [
        '06:00 AM',
        '06:30 AM',
        '07:00 AM',
        '07:30 AM',
        '08:00 AM',
        '08:30 AM',
        '09:00 AM',
        '09:30 AM',
        '10:00 AM',
        '10:30 AM',
        '11:00 AM',
        '11:30 AM',
        '12:00 PM',
        '12:30 PM',
        '01:00 PM',
        '01:30 PM',
        '02:00 PM',
        '02:30 PM',
    ];

    private static $autoPauseTimes = [
        '06:00 PM',
        '06:30 PM',
        '07:00 APM',
        '07:30 PM',
        '08:00 PM',
        '08:30 PM',
        '09:00 PM',
        '09:30 PM',
        '10:00 PM',
        '10:30 PM',
        '11:00 PM',
        '11:30 PM',
        '12:00 AM',
        '12:30 AM',
        '01:00 AM',
        '01:30 AM',
        '02:00 AM',
        '02:30 AM',
    ];

    /**
     * @return array
     */
    public static function getAutoPlayTimes(): array {
        return self::$autoPlayTimes;
    }

    /**
     * @return array
     */
    public static function getAutoPauseTimes(): array {
        return self::$autoPauseTimes;
    }


}
