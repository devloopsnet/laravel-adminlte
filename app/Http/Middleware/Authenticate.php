<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

/**
 * Class Authenticate
 *
 * @package App\Http\Middleware
 * @date 2019-06-23
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Authenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function redirectTo( $request ): ?string {
        if ( ! $request->expectsJson() ) {

            switch ( $request->getHost() ) {
                case 'admin.' . env( 'APP_DOMAIN' ):
                    return route( 'admin.login' );
                case 'app.' . env( 'APP_DOMAIN' ):
                    return route( 'user.login' );
                case 'company.' . env( 'APP_DOMAIN' ):
                    return route( 'company.login' );
            }
        }

        return null;
    }
}
