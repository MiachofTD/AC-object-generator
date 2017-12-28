<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 12/9/17
 * Time: 8:00 PM
 */

use Illuminate\Support\Facades\Route;

if ( !function_exists( 'current_route' ) ) {
    /**
     * Get the current route
     *
     * @return null|string
     */
    function current_route()
    {
        return Route::getCurrentRoute();
    }
}
