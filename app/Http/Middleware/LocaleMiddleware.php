<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class LocaleMiddleware
 *
 * @package App\Http\Middleware
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class LocaleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param Closure $next
	 *
	 * @return mixed
	 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
	 */
	public function handle( Request $request, Closure $next ) {
		App::setLocale( $request->header( 'locale', 'en' ) );		

		return $next( $request );
	}
}
