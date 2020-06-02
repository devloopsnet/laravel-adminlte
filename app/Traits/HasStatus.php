<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasStatus
 *
 * @property int status
 *
 * @method static Builder|self active()
 * @method static Builder|self inactive()
 *
 * @package App\Traits
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
trait HasStatus {

	/**
	 * Define active() scope
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function scopeActive( Builder $builder ): Builder {
		return $builder->where( 'status', '=', '1' );
	}

	/**
	 * Define inactive() scope
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $builder
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function scopeInactive( Builder $builder ): Builder {
		return $builder->where( 'status', '=', '0' );
	}

	/**
	 * Check if active
	 *
	 * @return bool
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function isActive(): bool {
		return (int) $this->status === 1;
	}

}