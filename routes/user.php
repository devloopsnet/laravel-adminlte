<?php

Route::domain( 'app.' . env( 'APP_DOMAIN' ) )->name( 'user.' )->group( static function () {

    Route::middleware( 'guest' )->group( static function () {

    } );

    Route::middleware( 'auth:user' )->group( static function () {

    } );

} );
