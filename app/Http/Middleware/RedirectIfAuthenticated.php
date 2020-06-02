<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle( $request, Closure $next, $guard = null ) {
        if ( Auth::guard( $guard )->check() ) {
            switch ( $request->getHost() ) {
                case 'admin.' . env( 'APP_DOMAIN' ):
                    return route( 'admin.dashboard.index' );
                case 'app.' . env( 'APP_DOMAIN' ):
                    return route( 'user.dashboard' );
                case 'company.' . env( 'APP_DOMAIN' ):
                    return route( 'company.dashboard' );
            }
        }

        return $next( $request );
    }
}
