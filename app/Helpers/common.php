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

if ( !function_exists( 'rand_float' ) ) {
    /**
     * @param int $min
     * @param int $max
     * @param int $decimalPlaces
     *
     * @return float|int
     */
    function rand_float( $min = 0, $max = 1, $decimalPlaces = 1 )
    {
        $decimal = '.';
        for ( $i = 0; $i < $places - 1; $i++ ) {
            $decimal .= '0';
        }
        $decimal .= '1';

        return rand( $min, $max ) * $decimal;
    }
}
