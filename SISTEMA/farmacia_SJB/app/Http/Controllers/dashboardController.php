<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{ 
    public fuction index()
    {
        return view('TEMPLATES.administrador');
    }
}
