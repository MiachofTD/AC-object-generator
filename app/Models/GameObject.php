<?php

namespace AC\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class GameObject extends Model
{
    /**
     * @var array
     */
    protected $cast = [
        'bool' => [
            'int.33',
            'int.114',
        ],
    ];

    /**
     * Mutate the spellbook attribute to use a specific json option when encoding
     *
     * @param $value
     */
    public function setSpellbookAttribute( $value )
    {
        $this->attributes[ 'spellbook' ] = json_encode( $value, JSON_PRESERVE_ZERO_FRACTION );
    }

    /**
     * Mutate the float attribute to use a specific json option when encoding
     *
     * @param $value
     */
    public function setFloatAttribute( $value )
    {
        $this->attributes[ 'float' ] = json_encode( $value, JSON_PRESERVE_ZERO_FRACTION );
    }

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function mapData( Request $request )
    {
        //Cast all boolean values appropriately, even if they don't exist.
        $all = $request->except( [ '_token' ] );
        foreach ( $this->cast[ 'bool' ] as $key ) {
            $value = filter_var( $request->input( $key, 0 ), FILTER_VALIDATE_BOOLEAN );

            data_set( $all, $key, $value );
        }

        foreach ( $all as $key => $value ) {
            $camelCase = camel_case( $key );

            if ( is_null( $value ) ) {
                continue;
            }

            $this->{$camelCase} = $value;
        }

        /** @todo Change tier attribute from hard-coded to a random value between 1 and 9 */
        $this->setAttribute( 'tier', 7 );

        return $this;
    }

    /**
     * @param mixed $stats
     *
     * @return array
     */
    protected function convertStatsToJson( $stats )
    {
        $json = [];
        if ( !is_array( $stats ) ) {
            return $json;
        }

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
            'intStats' => $this->convertStatsToJson( $this->getAttribute( 'int' ) ),
            'boolStats' => $this->convertStatsToJson( $this->getAttribute( 'bool' ) ),
            'floatStats' => $this->convertStatsToJson( $this->getAttribute( 'float' ) ),
            'didStats' => $this->convertStatsToJson( $this->getAttribute( 'did' ) ),
            'stringStats' => $this->convertStatsToJson( $this->getAttribute( 'string' ) ),
            'spellbook' => $this->convertStatsToJson( $this->getAttribute( 'spellbook' ) ),
            'wcid' => (int)$this->getAttribute( 'wcid' ),
            'weenieType' => $this->getAttribute( 'weenieType' ),
        ];

        if ( $pretty ) {
            return json_encode( $json, JSON_PRETTY_PRINT | JSON_PRESERVE_ZERO_FRACTION );
        }

        return json_encode( $json, JSON_PRESERVE_ZERO_FRACTION );
    }

    /**
     * @return bool
     */
    public function isWearable()
    {
        return false;
    }

}
