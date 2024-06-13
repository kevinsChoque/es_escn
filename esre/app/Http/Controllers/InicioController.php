<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function actBienvenida()
    {
    	return view('inicio.bienvenida');
    	// return view('layout.layout');
    }
}
