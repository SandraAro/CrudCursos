<div class="card-group">
    @foreach ($cursos as $curso)
            <div class="card px-2">
                <img src="{{ $this->getImage($curso->name)}}" class="card-img-top" alt="..." style="max-width:150px">
                <div class="card-body">
                    <h5 class="card-title"><strong>Curso {{$curso->id}}:</strong> {{$curso->title}}</h5>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Ir a algún lugar</a> <br><br>
                    <button class="btn btn-primary" style="max-width:100px">Eliminar</button> <br><br>
                    <small class="text-muted">Última actualización hace 3 minutos</small>
                </div>
            </div>
        @endforeach
</div>
