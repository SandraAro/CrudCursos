<div>
    <label class="text-primary">Seleccione una categoria</label>

    <select name="category" wire:model="course.category_id" placeholder="Categorias">
        <option value=" ">Categorias</option>
        @foreach ($selects['categories'] as $key => $category)
            <option value="{{$key}}">{{$category}}</option>
        @endforeach
    </select><br><br>

    <label class="text-primary">Seleccione una asignatura</label>

    <select name="assigments" wire:model="course.assigment_id" placeholder="Asignaturas">
        <option value=" ">Asignaturas</option>
        @foreach ($selects['assigments'] as $key => $assigment)
            <option value="{{$key}}"> {{$assigment}}</option>
        @endforeach
    </select><br><br>

    <label class="text-primary">Nombre del curso</label>
    <input type="text" class="border border-2 form-control" wire:model="course.name"> <br>

    <label class="text-primary">Descripción del curso</label>
    <input type="text" class="border border-2 form-control" wire:model="course.description"> <br>

    <div class="form-group">
        <label>Imagen:</label>
        <input type="file" class="form-control @error('course.image') is-invalid @enderror" wire:model="course.image">
        @error('course.image')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <button wire:click="toCreate()">Crear</button>
 </div>
