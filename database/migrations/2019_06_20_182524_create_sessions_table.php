<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSessionsTable
 *
 * @date 11/30/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateSessionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'sessions', static function ( Blueprint $table ) {
            $table->string( 'id' )->unique();
            $table->unsignedBigInteger( 'user_id' )->nullable();
            $table->string( 'ip_address', 45 )->nullable();
            $table->text( 'user_agent' )->nullable();
            $table->text( 'payload' );
            $table->integer( 'last_activity' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists( 'sessions' );
    }
}
