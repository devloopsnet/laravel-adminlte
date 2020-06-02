<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOauthClientsTable
 *
 * @date 12/1/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateOauthClientsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void {
    Schema::create('oauth_clients', static function (Blueprint $table) {
      $table->increments('id');
      $table->bigInteger('user_id')->index()->nullable();
      $table->string('name');
      $table->string('secret', 100)->nullable();
      $table->text('redirect');
      $table->boolean('personal_access_client');
      $table->boolean('password_client');
      $table->boolean('revoked');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(): void {
    Schema::dropIfExists('oauth_clients');
  }

}
