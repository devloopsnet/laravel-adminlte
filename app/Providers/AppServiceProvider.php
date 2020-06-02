<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void {

    }

    /**
     * Bootstrap any application services.
     *
     * @param UrlGenerator $urlGenerator
     *
     * @return void
     */
    public function boot( UrlGenerator $urlGenerator ): void {
        $urlGenerator->forceScheme( 'https' );


        User::observe( UserObserver::class );


        Validator::extend( 'exists_if', static function ( $attribute, $value, $parameters, $validator ) {
            [ $Table, $Column, $Param, $Operator, $Value ] = $parameters;
            $Boolean = true;
            switch ( $Operator ) {
                case '!=':
                    $Boolean = request()->get( $Param ) != $Value;
                    break;
                case '=':
                    $Boolean = request()->get( $Param ) == $Value;
                    break;
                default:
                    break;
            }
            if ( $Boolean ) {
                return DB::table( $Table )->where( $Column, '=', $value )->count() > 0;
            }

            return true;
        } );

        Blade::directive( 'allow', static function ( $expression ) {
	        $expression = str_replace( "'", '', $expression );
	        $condition  = 'admin_can(\'' . $expression . '\')';

	        return "<?php if ($condition) { ?>";
        } );


        Blade::directive( 'endallow', static function () {
            return '<?php } ?>';
        } );
    }
}
