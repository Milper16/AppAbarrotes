<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class principalController extends Controller
{
    //
    public function index()
    {
    	$nombre="Tienda de MPerez";
    	$descripcion="Bienvenido a mi Tienda";
    	// return view('index')->with('nombreTienda',$nombre)->with('descripcion',$descripcion);
    	return view('index')->with(['nombreTienda'=>$nombre, 'descripcion'=>$descripcion]);
    }
}
