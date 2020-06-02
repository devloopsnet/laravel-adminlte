<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMediaTable
 *
 * @date 11/30/19
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class CreateMediaTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'media', static function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->morphs( 'model' );
            $table->string( 'collection_name' );
            $table->string( 'name' );
            $table->string( 'file_name' );
            $table->string( 'mime_type' )->nullable();
            $table->string( 'disk' );
            $table->unsignedInteger( 'size' );
            $table->json( 'manipulations' );
            $table->json( 'custom_properties' );
            $table->json( 'responsive_images' );
            $table->unsignedInteger( 'order_column' )->nullable();
            $table->nullableTimestamps();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists( 'media' );
    }
}
