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

if ( !function_exists( 'dropdown_options' ) ) {
    /**
     * @param string $configKey
     *
     * @return string
     */
    function dropdown_options( $configKey )
    {
        $itemList = collect( config( $configKey, [] ) );
        $items = '';

        foreach ( $itemList as $item ) {
            $items .= '<option value="' . $item[ 'id' ] . '">' . $item[ 'name' ] . '</option>';
        }

        return $items;
    }
}

if ( !function_exists( 'dropdown_options_group' ) ) {
    /**
     * @param string $configKey
     *
     * @return string
     */
    function dropdown_options_group( $configKey )
    {
        $itemGroups = collect( config( $configKey, [] ) );
        $items = '';

        foreach ( $itemGroups as $group => $itemList ) {
            foreach ( $itemList as $item ) {
                $items .= '<option value="' . $item[ 'id' ] . '">' . $item[ 'name' ] . '</option>';
            }

            if ( $group != $itemGroups->keys()->last() ) {
                $items .= '<option value disabled> ... </option>';
            }
        }

        return $items;
    }
}

if ( !function_exists( 'dropdown_options_category' ) ) {
    /**
     * @param $configKey
     * @param $category
     *
     * @return string
     */
    function dropdown_category( $configKey, $category )
    {
        $itemGroups = collect( config( $configKey, [] ) );
        $category = studly_case( $category );

        $items = '<optgroup label="--- ' . $category . ' ---">';

        foreach ( $itemGroups as $item ) {
            $items .= '<option value="' . $item[ 'id' ] . '">' . $item[ 'name' ] . '</option>';
        }

        $items .= '</optgroup>';

        return $items;
    }
}
