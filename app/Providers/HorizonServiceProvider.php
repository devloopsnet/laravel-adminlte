<?php

namespace App\Providers;

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

/**
 * Class HorizonServiceProvider
 *
 * @package App\Providers
 * @date 2019-07-09
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class HorizonServiceProvider extends HorizonApplicationServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void {
        parent::boot();

        Horizon::routeSmsNotificationsTo( '+962798829099' );
        Horizon::routeMailNotificationsTo( 'abdullah@devloops.net' );
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');

        Horizon::night();
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate(): void {
        Gate::define( 'viewHorizon', static function ( $user ) {
            return admin()->hasRole( 'super-admin' );
        } );
    }
}
