@extends('layouts.plantilla')

@section('title', 'INICIO')

@section('content')
    <h1 class='text-danger'>Bienvenidos a la pagina de Cursos</h1>
    <h3 class='text-info'>Aquí encontraras cursos relacionados a la programación web</h3>
    <a href="cursos/create">Crear Curso</a>
    <hr>
    <div class="card-group">
        <h1 class='text-success'>Lista de cursos disponibles</h1> <hr>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Ejemplo en Livewire para listar archivos
                </div>
                <div class="card-body">
                    @livewire('list-file')
                </div>
            </div>
        </div>
        <hr>
        <h1 class='text-success'>Cargar imagen de card</h1>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Ejemplo en Livewire para cargar archivos
                </div>
                <div class="card-body">
                    @livewire('file-upload')
                </div>
            </div>
        </div>
    </div>
@endsection

