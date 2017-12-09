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
     * @var int
     */
    public $weenieType;

    /**
     * @var array
     */
    public $int = [];

    /**
     * @var array
     */
    public $bool = [];

    /**
     * @var array
     */
    public $float = [];

    /**
     * @var array
     */
    public $did = [];

    /**
     * @var array
     */
    public $string = [];

    /**
     * @var array
     */
    public $spellbook = [];

    /**
     * @var array
     */
    public $spells = [];

    /**
     * GameObject constructor.
     *
     * @param Request $request
     */
    public function __construct( Request $request )
    {
        $this->mapData( $request );
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    protected function mapData( Request $request )
    {
        foreach ( $request->all() as $key => $value ) {
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

    /**
     * @param bool $pretty
     *
     * @return string
     */
    public function convertToJson( $pretty = true )
    {
        $json = [
            'intStats' => $this->convertStatsToJson( $this->int ),
            'boolStats' => $this->convertStatsToJson( $this->bool ),
            'floatStats' => $this->convertStatsToJson( $this->float ),
            'didStats' => $this->convertStatsToJson( $this->did ),
            'stringStats' => $this->convertStatsToJson( $this->string ),
            'spellbook' => $this->convertStatsToJson( $this->spellbook ),
            'wcid' => (int)$this->wcid,
            'weenieType' => $this->weenieType,
        ];

        if ( $pretty ) {
            return json_encode( $json, JSON_PRETTY_PRINT );
        }

        return json_encode( $json );
    }
}
