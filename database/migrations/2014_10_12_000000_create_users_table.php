<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 *
 * @date 2019-06-20
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void {
		Schema::create( 'users', static function ( Blueprint $table ) {
			$table->bigIncrements( 'id' )->index();
			$table->string( 'fb_id' )->nullable();
			$table->string( 'first_name' );
			$table->string( 'last_name' );
			$table->string( 'phone_number' )->unique()->index();
			$table->string( 'email' )->unique();
			$table->enum( 'gender', [ 'male', 'female' ] );
			$table->double( 'wallet' )->default( 0.0 );
			$table->string( 'password' );
			$table->bigInteger( 'points' )->default( 0 );
			$table->longText( 'firebase_token' )->nullable();
			$table->enum( 'locale', [ 'ar', 'en' ] )->default( 'en' );
			$table->enum( 'status', [ 0, 1, 2 ] )->default( 1 );//0 Inactive, 1 Active, 2 Blocked.
			$table->json( 'settings' )->nullable();
			$table->rememberToken();
			$table->timestamp( 'last_login' )->nullable();
			$table->softDeletes();
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void {
		Schema::dropIfExists( 'users' );
	}
}
