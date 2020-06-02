<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class Status
 *
 * @package App\Enums
 * @date 2/9/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Status extends Enum {

	public const INACTIVE = 0;

	public const ACTIVE = 1;

	/**
	 * return textual representation of the status
	 *
	 * @param int $status
	 *
	 * @return array|string|null
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public static function parse( int $status ) {
		switch ( $status ) {
			case self::INACTIVE:
				return __( 'Inactive' );
			case self::ACTIVE:
				return __( 'Active' );
			default:
				return __( 'Unknown' );
		}
	}

}
