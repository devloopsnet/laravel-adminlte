<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSettingsTable
 *
 * @date 2019-07-13
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create( 'settings', static function ( Blueprint $table ) {
			$table->bigIncrements( 'id' )
			      ->index();
			$table->string( 'key' );
			$table->longText( 'value' );
			$table->bigInteger( 'admin_id' )
			      ->unsigned()
			      ->index();

			$table->timestamps();
		} );

		Schema::table( 'settings', static function ( Blueprint $table ) {
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
		Schema::dropIfExists( 'settings' );
	}
}
