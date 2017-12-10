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
            $table->string( 'tier' );
            $table->text( 'data' )->nullable();

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
