<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * Class PassportMultiAuthMiddleware
 *
 * @package App\Http\Middleware
 * @date 2019-07-12
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class PassportMultiAuthMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     * @author Abdullah Al-Faqeir <abdullah@devloops.net>
     */
    public function handle( $request, Closure $next ) {
        $params = $request->all();
        if ( array_key_exists( 'provider', $params ) ) {
            Config::set( 'auth.guards.api.provider', $params['provider'] );
        }

        return $next( $request );
    }
}
