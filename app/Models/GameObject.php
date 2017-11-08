<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 10/25/17
 * Time: 6:50 PM
 */

namespace AC\Models;

use Illuminate\Http\Request;

abstract class GameObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $wcid;

    /**
     * @param bool $pretty
     *
     * @return string
     */
    abstract public function convertToJson( $pretty = true );

    /**
     * GameObject constructor.
     *
     * @param Request $request
     */
    public function __construct( Request $request )
    {
        $this->mapData( $request->all() );
    }

    /**
     * @param array $request
     *
     * @return $this
     */
    protected function mapData( array $request )
    {
        foreach ( $request as $key => $value ) {
            $camelCase = camel_case( $key );

            $this->{$camelCase} = $value;
        }

        return $this;
    }

    /**
     * @param $stats
     *
     * @return array
     */
    protected function convertStatsToJson( $stats )
    {
        $json = [];
        foreach ( $stats as $key => $value ) {
            $json[] = [ 'key' => $key, 'value' => $value ];
        }

        return $json;
    }
}
