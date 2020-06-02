<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class JordanianNumber
 *
 * @package App\Rules
 * @date 2/9/20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class JordanianNumber implements Rule {

	/**
	 * @var string
	 */
	protected $message;

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param string $attribute
	 * @param mixed  $value
	 *
	 * @return bool
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function passes( $attribute, $value ): bool {
		$value  = (int) $value;
		$JoCode = substr( (string) $value, 0, 3 );
		if ( $JoCode === '962' ) {
			$Carrier = substr( (string) $value, 3, 2 );
			if ( in_array( $Carrier, [ '78', '77', '79' ], false ) ) {
				return true;
			}
			$this->message = __( 'Invalid carrier.' );

			return false;
		}
		$this->message = __( 'Invalid Jordanian country code.' );

		return false;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function message(): string {
		return $this->message;
	}
}
