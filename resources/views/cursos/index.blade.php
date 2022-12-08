@extends('layouts.plantilla')

@section('title', 'INICIO')

@section('content')
    <h1 class='text-danger'>Bienvenidos a la pagina de Cursos</h1>
    <h3 class='text-info'>Aquí encontraras cursos relacionados a la programación web</h3>
    <a href="cursos/create">Crear Curso</a>

    <div class="card-group">
        {{-- @foreach ($cursos as $curso)
            <div class="card px-2">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><strong>Curso {{$curso->id}}:</strong> {{$curso->name}}</h5>
                    <p class="card-text"><strong>Descripción:</strong><br>{{$curso->description}}</p>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ir a algún lugar</a> <br><br>
                    <small class="text-muted">Última actualización hace 3 minutos</small>
                </div>
            </div>
        @endforeach --}}
    {{-- {{$cursos->links()}} --}}
    </div>

    <h1 class='text-success'>Cargar imagen de card</h1>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Ejemplo en Livewire para cargar archivos
            </div>
            <div class="card-body">
                @livewire('file-upload')
                {{-- @livewire('test') --}}
            </div>
        </div>
    </div>
@endsection

       @livewire('list-file')

        {{-- <div class="card px-2">
          <img src="{{asset('curso-js.png')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Título de la tarjeta</h5>
            <p class="card-text">Esta es una tarjeta más amplia con texto de apoyo a continuación como introducción natural a contenido adicional. Este contenido es un poco más largo.</p>
          </div>
          <div class="card-footer">
              <a href="#" class="btn btn-primary">Ir a algún lugar</a> <br><br>
              <small class="text-muted">Última actualización hace 3 minutos</small>
          </div>
        </div>

        <div class="card px-2">
          <img src="{{asset('python.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Título de la tarjeta</h5>
            <p class="card-text">Esta tarjeta tiene texto de apoyo a continuación como una introducción natural a contenido adicional.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Ir a algún lugar</a> <br><br>
            <small class="text-muted">Última actualización hace 3 minutos</small>
          </div>
        </div>

        <div class="card px-2">
          <img src="{{asset('c++.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Título de la tarjeta</h5>
            <p class="card-text">Esta es una tarjeta más amplia con texto de apoyo a continuación como introducción natural a contenido adicional. Este contenido es un poco más largo.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Ir a algún lugar</a> <br><br>
            <small class="text-muted">Última actualización hace 3 minutos</small>
          </div>
        </div> --}}
