<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\File;
use Illuminate\Http\Request;


class CursoController extends Controller
{
    //método encargado de mostrar la página principal
    public function index()
    {
        //$cursos = Curso::latest()->paginate();

        //pasar una variable a una vista
        return view('cursos.index');
    }

    //método encargado de crear el formulario del curso
    public function create()
    {
        return view('cursos.create');
    }

    //método encargado de mostrar un curso
    public function show($cursos)
    {
        /* return view('cursos.show', ['b' => $cursos]); */
        /* ****************************************** */
        return view('cursos.show', compact('cursos'));
    }

    //método encargado de mostrar la categoria a la que pertenece un curso
    public function showCategory($cursos, $categoria)
    {
        return view('cursos.showCategory', ['curso' => $cursos, 'categoria' => $categoria]);
    }
}

//Para imprimir la variable curso que viene por la url debo pasarla como segundo parametro del metodo view
//creo la variable 'curso' y le asigno la variable que me pasan por parametro en el funcion
//si aqui defino una variable 'a' la que imprimo en el html debe ser '$a'
// uso el metodo compact() cuando la variable que recibo por parametro coincide con la que creo en el metodo compact
