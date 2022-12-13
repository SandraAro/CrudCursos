<div>
    <label class="text-primary">Seleccione una categoria</label>

    {{-- <select name="category" wire:model="course.category_id" placeholder="Categorias">
        <option value=" ">Categorias</option>
        @foreach ($selects['categories'] as $key => $category)
            <option value="{{$key}}">{{$category}}</option>
        @endforeach
    </select><br><br> --}}
    {{-- @dump($course) --}}
    <table>
        <tr>
            <th>Seleccionar</th>
            <th>Categoria</th>
        </tr>
        <tbody>
            @foreach ($categories as $key => $category)
                <tr>
                    <td><input type="checkbox" wire:model="checks.{{$key}}" wire:change='selectedCategory({{$key}}, {{$category->id}})'></td>
                    <td>{{$category->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <tr>
            <th>Seleccionar</th>
            <th>Asignaciones</th>
        </tr>
        <tbody>
            @foreach ($assigments as $key => $assigment)
                <tr>
                    <td><input type="checkbox" wire:model="assigmentsChecks.{{$key}}" wire:change='selectedAssigment({{$key}}, {{$assigment->id}})'></td>
                    <td>{{$assigment->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- @dump($assigmentsChecks,$assigmentsSelected) --}}
    {{-- <button wire:click=saveCategory()>Guardar</button> --}}
{{--
    <label class="text-primary">Seleccione una asignatura</label>

    <select name="assigments" wire:model="course.assigment_id" placeholder="Asignaturas">
        <option value=" ">Asignaturas</option>
        @foreach ($selects['assigments'] as $key => $assigment)
            <option value="{{$key}}"> {{$assigment}}</option>
        @endforeach
    </select><br><br> --}}

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
