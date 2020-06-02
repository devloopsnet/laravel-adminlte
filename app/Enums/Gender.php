<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class Gender
 *
 * @package App\Enums
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Gender extends Enum {

	public const MALE = 'male';
	public const FEMALE = 'female';

	/**
	 * Parse gender int to string
	 *
	 * @param string $gender
	 *
	 * @return string|null
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public static function parse( string $gender ): ?string {
		switch ( $gender ) {
			case 'male':
				return __( 'Male', [], getLoggedUserLocale() );
			case 'female':
				return __( 'Female', [], getLoggedUserLocale() );
			default:
				return __( 'Unknown', [], getLoggedUserLocale() );
		}
	}

}
