<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CursoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'index']);

//Rutas con un mismo controlador (Agrupación de rutas)
Route::controller(CursoController::class)->group(function(){
    //la vista es recomendable colocarle el mismo nombre del metodo dentro de una carpeta con el nombre de la ruta(cursos)
    Route::get('cursos', 'index')->name('cursos');
    Route::get('image-upload', 'index')->name('archivos');
    Route::get('cursos/create', 'create');
    Route::get('cursos/{cursos}', 'show');
    Route::get('cursos/{cursos}/{categoria}', 'showCategory');
});

Route::get('category', function(){
    return view('content.category');
});
Route::get('assigment', function(){
    return view('content.assigment');
});
Route::get('course', function(){
    return view('content.course');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
