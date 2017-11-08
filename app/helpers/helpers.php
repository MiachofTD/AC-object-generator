<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/30/17
 * Time: 5:49 PM
 */

use AC\Application;
use Illuminate\Container\Container;

if ( !function_exists( 'config' ) ) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string $key
     * @param  mixed        $default
     *
     * @return mixed
     */
    function config( $key = null, $default = null )
    {
        $app = new Application();
        $config = $app->bootstrapConfig();

        if ( is_null( $key ) ) {
            return $config;
        }

        if ( is_array( $key ) ) {
            return $config->set( $key );
        }

        return $config->get( $key, $default );
    }
}

if ( !function_exists( 'app' ) ) {
    /**
     * Get the available container instance.
     *
     * @param  string $make
     * @param  array  $parameters
     *
     * @return mixed
     */
    function app( $make = null, $parameters = [] )
    {
        if ( is_null( $make ) ) {
            return Container::getInstance();
        }

        return Container::getInstance()->make( $make, $parameters );
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
