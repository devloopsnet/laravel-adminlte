<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFailedJobsTable
 *
 * @date 11/30/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateFailedJobsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'failed_jobs', static function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->text( 'connection' );
            $table->text( 'queue' );
            $table->longText( 'payload' );
            $table->longText( 'exception' );
            $table->timestamp( 'failed_at' )->useCurrent();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists( 'failed_jobs' );
    }
}
