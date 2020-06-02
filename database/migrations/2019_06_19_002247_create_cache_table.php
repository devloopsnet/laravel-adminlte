<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCacheTable
 *
 * @date 11/30/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateCacheTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'cache', static function ( Blueprint $table ) {
            $table->string( 'key' )->unique();
            $table->mediumText( 'value' );
            $table->integer( 'expiration' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists( 'cache' );
    }
}
