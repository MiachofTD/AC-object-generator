<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'armor', function ( Blueprint $table ) {
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

        DB::statement('ALTER TABLE armor AUTO_INCREMENT = 7200000000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'armor' );
    }
}
