<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class UserStatus
 * @package App\Enums
 * @date 11/23/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class UserStatus extends Enum {
    public const INACTIVE = 0;

    public const ACTIVE = 1;

    public const BLOCKED = 2;

    /**
     * Reverse parse status
     *
     * @param $status
     *
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public static function reverseParse( $status ) {
        switch ( (int) $status ) {
            case self::INACTIVE:
                return __( 'Inactive' );
            case self::ACTIVE:
                return __( 'Active' );
            case self::BLOCKED:
                return __( 'Blocked' );
            default:
                return __( 'Unknown status :status', [ 'status' => $status ] );
        }
    }
}
