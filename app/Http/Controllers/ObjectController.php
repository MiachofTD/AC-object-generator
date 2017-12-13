<?php

namespace AC\Http\Controllers;

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
}
