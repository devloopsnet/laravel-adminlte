<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOauthAuthCodesTable
 *
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateOauthAuthCodesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'oauth_auth_codes', static function ( Blueprint $table ) {
            $table->string( 'id', 100 )->primary();
            $table->bigInteger( 'user_id' );
            $table->unsignedInteger( 'client_id' );
            $table->text( 'scopes' )->nullable();
            $table->boolean( 'revoked' );
            $table->dateTime( 'expires_at' )->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists( 'oauth_auth_codes' );
    }
}
