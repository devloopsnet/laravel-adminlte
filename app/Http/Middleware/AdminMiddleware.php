<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Class AdminMiddleware
 * @package App\Http\Middleware
 * @date 2019-06-25
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AdminMiddleware {
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
        $permission = Route::current()->action['permission'] ?? null;
        if ( $permission ) {
            try {
                if ( admin()->hasRole( 'super-admin' ) || admin()->hasPermissionTo( $permission ) ) {
                    return $next( $request );
                }
                abort( 403, 'Unauthorized action.' );
            } catch ( \Exception $e ) {
                abort( 403, 'Unauthorized action.' );
            }
        }

        return $next( $request );
    }
}
