<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeaponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'weapon', function ( Blueprint $table ) {
            $table->bigIncrements( 'wcid' );
            $table->string( 'type' );
            $table->string( 'tier' );
            $table->string( 'weenieType' );
            $table->text( 'int' )->nullable();
            $table->text( 'bool' )->nullable();
            $table->text( 'float' )->nullable();
            $table->text( 'did' )->nullable();
            $table->text( 'string' )->nullable();
            $table->text( 'spellbook' )->nullable();

            $table->timestamps();
        } );

        DB::statement('ALTER TABLE weapon AUTO_INCREMENT = 8200000000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'weapon' );
    }
}
