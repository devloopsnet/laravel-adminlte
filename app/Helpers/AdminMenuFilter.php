<?php


namespace App\Helpers;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

/**
 * Class AdminMenuFilter
 *
 * @package App\Helpers
 * @date 2019-06-24
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AdminMenuFilter implements FilterInterface {

	/**
	 * Filter Admin Menu
	 *
	 * @param         $item
	 * @param Builder $builder
	 *
	 * @return bool|array
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function transform( $item, Builder $builder ) {
		if ( admin()->hasRole( 'super-admin' ) || admin()->can( $item['permission'] ) ) {
			return $item;
		}

		return false;
	}
}