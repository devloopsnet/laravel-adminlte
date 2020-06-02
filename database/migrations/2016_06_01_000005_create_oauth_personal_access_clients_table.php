<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOauthPersonalAccessClientsTable
 *
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateOauthPersonalAccessClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'oauth_personal_access_clients', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'client_id' )->index();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists( 'oauth_personal_access_clients' );
    }
}
