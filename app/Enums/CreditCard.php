<?php

namespace App\Enums;

use Nasyrov\Laravel\Enums\Enum;

/**
 * Class CreditCard
 *
 * @package App\Enums
 * @date 2/13/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreditCard extends Enum {

	public const VISA = 'visa';

	public const MASTERCARD = 'mastercard';

	public const AMERICAN_EXPRESS = 'american_express';

	/**
	 * Return textual representaion of the credit card type
	 *
	 * @param string $type
	 *
	 * @return string
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public static function parse( string $type ): ?string {
		switch ( $type ) {
			case self::VISA:
				return __( 'Visa' );
			case self::MASTERCARD:
				return __( 'MasterCard' );
			case self::AMERICAN_EXPRESS:
				return __( 'America Express' );
			default:
				return __( 'Unknown :type', [ 'type' => $type ] );
		}
	}

}
