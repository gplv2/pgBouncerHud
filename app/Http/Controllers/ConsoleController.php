<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ConsoleController extends Controller
{
    /**
     * Show the Offered services
     *
     * @return Response
     */
    public function showConsole()
    {
        return view('console');
    }

    public function showConfig()
    {
        return view('config');
    }

    public function showAbout()
    {
        return view('about');
    }
}
