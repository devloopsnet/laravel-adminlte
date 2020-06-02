<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [// 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void {
        $this->registerPolicies();

        Route::group( [ 'middleware' => 'passport-multiAuth' ], static function () {
            Passport::routes();
        } );
    }
}
