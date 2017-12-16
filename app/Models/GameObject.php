<?php

namespace AC\Models;

use Illuminate\Database\Eloquent\Model;

abstract class GameObject extends Model
{
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
            return json_encode( $json, JSON_PRETTY_PRINT );
        }

        return json_encode( $json );
    }
}
