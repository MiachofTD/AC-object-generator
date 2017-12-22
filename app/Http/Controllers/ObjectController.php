<?php

namespace AC\Http\Controllers;

use AC\Models\Armor;
use AC\Models\Jewelry;
use AC\Traits\Wearable;
use AC\Models\GameObject;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function worldItem( Request $request )
    {
        return response()->view( 'world-item' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function jewelry( Request $request )
    {
        return response()->view( 'jewelry' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function armor( Request $request )
    {
        return response()->view( 'armor' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function weapon( Request $request )
    {
        return response()->view( 'weapon' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonObject( Request $request )
    {
        $object = null;
        switch( $request->get( 'objectType', '' ) )
        {
            case 'jewelry':
                $object = new Jewelry();
            break;
            case 'armor':
                $object = new Armor();
            break;
        }

        if ( !$object instanceof GameObject ) {
            abort( 404 );
        }

        $object->mapData( $request );

        dd( $object );

        //Only the wearable items need to be saved to the database. World items don't need to generate unique values
        if ( $object instanceof Wearable ) {
            $object->save();
        }

        $this->addContext( 'json', $object->convertToJson() );

        return response()->view( 'json-object', $this->context );
    }
}
