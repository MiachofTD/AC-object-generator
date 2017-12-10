<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return response()->view( 'dashboard' );
    }
}
