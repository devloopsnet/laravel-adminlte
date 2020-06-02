<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOauthRefreshTokensTable
 *
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateOauthRefreshTokensTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'oauth_refresh_tokens', static function ( Blueprint $table ) {
            $table->string( 'id', 100 )->primary();
            $table->string( 'access_token_id', 100 )->index();
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
        Schema::dropIfExists( 'oauth_refresh_tokens' );
    }
}
