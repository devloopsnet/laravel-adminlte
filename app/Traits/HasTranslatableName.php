<?php


namespace App\Traits;

use Illuminate\Support\Facades\App;

/**
 * Trait HasTranslatableName
 *
 * @property string name_ar
 * @property string name_en
 *
 * @package App\Traits
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait HasTranslatableName {

	/**
	 * @var array
	 */
	public $translatable = [ 'name' ];

	/**
	 * Define name_ar attribute
	 *
	 * @return string
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function getNameArAttribute(): ?string {
		return $this->translations['name']['ar'] ?? '';
	}

	/**
	 * Define name_en attribute
	 *
	 * @return string
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function getNameEnAttribute(): ?string {
		return $this->translations['name']['en'] ?? '';
	}

	/**
	 * name attribute mutator
	 *
	 * @param $title
	 *
	 * @return string
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function getTitleAttribute( $title ): string {
		if ( App::getLocale() === 'ar' ) {
			return $this->name_ar;
		}

		return $this->name_en;
	}

}