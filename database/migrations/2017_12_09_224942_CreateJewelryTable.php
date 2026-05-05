<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJewelryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'jewelry', function ( Blueprint $table ) {
            $table->bigIncrements( 'wcid' );
            $table->string( 'type' );
            $table->tinyinteger( 'tier' );
            $table->string( 'weenieType' );
            $table->text( 'int' )->nullable();
            $table->text( 'bool' )->nullable();
            $table->text( 'float' )->nullable();
            $table->text( 'did' )->nullable();
            $table->text( 'string' )->nullable();
            $table->text( 'spellbook' )->nullable();

            $table->timestamps();
        } );

        DB::statement('ALTER TABLE jewelry AUTO_INCREMENT = 9200000000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'jewelry' );
    }
}
