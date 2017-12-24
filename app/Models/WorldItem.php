<?php

namespace AC\Models;

use Illuminate\Http\Request;

class WorldItem extends GameObject
{
    /**
     * @var string
     */
    public $loc;

    /**
     * @var string
     */
    public $objcellId;

    /**
     * @var string
     */
    public $origin;

    /**
     * @var string
     */
    public $angles;

    /**
     * @param Request $request
     *
     * @return void
     */
    public function mapData( Request $request )
    {
        parent::mapData( $request );

        $this->extractLocation();
    }

    /**
     * @return $this
     */
    protected function extractLocation()
    {
        preg_match( '@([\s\S]+?) \[([\s\S]+?)\] (.*)@i', $this->loc, $matches );

        $this->objcellId = hexdec( isset( $matches[ 1 ] ) ? $matches[ 1 ] : '' );
        $this->origin = $this->extractCoordinates( isset( $matches[ 1 ] ) ? $matches[ 2 ] : '' );
        $this->angles = $this->extractcoordinates( isset( $matches[ 1 ] ) ? $matches[ 3 ] : '' );

        return $this;
    }

    /**
     * @param $rawParts
     *
     * @return array
     */
    protected function extractCoordinates( $rawParts )
    {
        $coordinates = [];
        $parts = array_reverse( explode( ' ', trim( $rawParts ) ) );
        $names = [ 'z', 'y', 'x', 'w' ];

        for ( $i = 0; $i < count( $parts ); $i++ ) {
            $name = $names[ $i ];
            $coordinate = (float)number_format( $parts[ $i ], 6 );

            $coordinates[ $name ] = (float)number_format( $coordinate, 6 );
        }

        return array_reverse( $coordinates, true );
    }

    /**
     * Convert the data passed in the form to json.
     *   Note: The array fields have to be in a specific order since the thing
     *   consuming the json is using text parsing to consume it.
     *
     * @param bool $pretty
     * @return string
     */
    public function convertToJson( $pretty = true )
    {
        $json = [
            'id' => (int)$this->id,
            'pos' => [],
            'wcid' => (int)$this->wcid,
        ];

        array_set( $json, 'pos.frame.angles', $this->angles );
        array_set( $json, 'pos.frame.origin', $this->origin );
        array_set( $json, 'pos.objcell_id', $this->objcellId );

        if ( $pretty ) {
            return json_encode( $json, JSON_PRETTY_PRINT ) . ',';
        }

        return json_encode( $json ) . ',';
    }
}
