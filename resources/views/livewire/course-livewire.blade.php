<div class="row">
    {{-- <img src="{{ url('cursos-images/'.'image.jpg')}}" alt="" style="height: 300px;">
    <img src="{{ $this->getImage('image.jpg')}}" alt="" style="height: 300px;" id="dffd"> --}}
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <table>
                        <tr>
                            <th class="text-primary">Categorias</th>
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
                </div>
                <hr>
                <div>
                    <table>
                        <tr>
                            <th class="text-primary">Asignaciones</th>
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
                </div>
                <hr>
                <div>
                    <label class="text-primary">Nombre del curso</label>
                    <input type="text" class="border border-2 form-control" wire:model="course.name"> <br>

                    <label class="text-primary">Descripción del curso</label>
                    <input type="text" class="border border-2 form-control" wire:model="course.description"> <br>

                    <div class="form-group">
                        <label class="text-primary">Imagen:</label>
                        <input type="file" class="form-control @error('course.image') is-invalid @enderror" wire:model="courseImage" id="{{ $image ? 'image1' : 'image2'}}">
                        @error('course.image')<span class="text-danger">{{ $message }}</span>@enderror
                        <div wire:loading wire:target="course.image">Uploading...</div>

                        <!-- Progress Bar -->
                        {{-- <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress" wire:target="course.image"></progress>
                        </div> --}}
                        {{-- <div wire:loading>
                            Procesando...
                        </div> --}}
                    </div>
                    @if ($action == 'create')
                    <button wire:click="toCreate()" class="btn btn-primary mt-2">Crear</button>
                    @else
                    <button wire:click="update()" class="btn btn-primary mt-2">Update</button>
                    @endif
                </div>
                <hr>
            </div>
        </div>
    </div>

    <div class="col-8 row">
        @foreach ($courses as $course)
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    @dump($this->getImage($course->image))
                    <img src="{{ $this->getImage($course->image)}}" class="card-img-top" alt="..." style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{$course->name}}</h5>
                        <p class="card-text">{{$course->description}}</p>
                        @foreach ($course->coursesCategories as $item)
                            <span class="badge bg-danger">{{ $item->categories->name}}</span>
                        @endforeach
                        <div class="mt-1">
                            {{-- <div class="mt-1" style="min-height: 50px; max-height: 50px; background: red; overflow:hidden"> --}}
                            <ul>
                                @if(count($course->coursesAssigments) > 2)
                                    Ver más
                                @else
                                    @foreach ($course->coursesAssigments as $courseAssigment)
                                        <li>{{$courseAssigment->assigment->name}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <button wire:click="destroy({{$course->id}})" class="btn btn-danger">Borrar</button>
                        <button wire:click='editCourse({{$course->id}})' class="btn btn-danger">Editar</button>
                    </div>
                </div>
            {{-- @dump($course->id) --}}
            </div>
        @endforeach
        </div>
    </div>


    {{-- <select name="category" wire:model="course.category_id" placeholder="Categorias">
        <option value=" ">Categorias</option>
        @foreach ($selects['categories'] as $key => $category)
            <option value="{{$key}}">{{$category}}</option>
        @endforeach
    </select><br><br> --}}
    {{-- @dump($course) --}}

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
</div>
