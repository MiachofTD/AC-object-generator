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

if ( !function_exists( 'float_rand' ) ) {
    /**
     * @param int $min
     * @param int $max
     * @param int $decimalPlaces
     *
     * @return float|int
     */
    function float_rand( $min = 0, $max = 1, $decimalPlaces = 1 )
    {
        $decimal = '.';
        for ( $i = 1; $i < $decimalPlaces; $i++ ) {
            $decimal .= '0';
        }
        $decimal .= '1';

        return number_format( rand( $min, $max ) * $decimal, $decimalPlaces );
    }
}
