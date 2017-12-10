<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group( [ 'middleware' => [ 'force.ssl', 'global.variables' ] ], function () {
    Route::get( '/', [ 'as' => 'dashboard', 'uses' => 'DashboardController@index' ] );

    Route::get( '/world-item', [ 'as' => 'world-item', 'uses' => 'ObjectController@worldItem' ] );
    Route::get( '/jewelry', [ 'as' => 'jewelry', 'uses' => 'ObjectController@jewelry' ] );
    Route::get( '/armor', [ 'as' => 'armor', 'uses' => 'ObjectController@armor' ] );
    Route::get( '/weapon', [ 'as' => 'weapon', 'uses' => 'ObjectController@weapon' ] );
});
