<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSystemNotificationsTable
 *
 * @date 2019-07-16
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateSystemNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create( 'system_notifications', static function ( Blueprint $table ) {
			$table->bigIncrements( 'id' )
			      ->index();
			$table->bigInteger( 'admin_id' )
			      ->unsigned()
			      ->index();
			$table->string( 'title' );
			$table->longText( 'body' );
			$table->longText( 'send_to_drivers' );
			$table->longText( 'send_to_users' );
			$table->softDeletes();
			$table->timestamps();
		} );

		Schema::table( 'system_notifications', static function ( Blueprint $table ) {
			$table->foreign( 'admin_id' )
			      ->references( 'id' )
			      ->on( 'admins' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void {
		Schema::dropIfExists( 'system_notifications' );
	}
}
