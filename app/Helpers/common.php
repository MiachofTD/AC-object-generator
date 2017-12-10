<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 12/9/17
 * Time: 8:00 PM
 */

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
