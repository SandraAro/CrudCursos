<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //__invoke es para administrar una unica ruta
    public function __invoke()
    {
        return 'Bienvenidos a la página principal';
    }
}
