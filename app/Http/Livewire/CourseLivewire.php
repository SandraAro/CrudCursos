<?php

namespace App\Http\Livewire;

use App\Models\Assigment;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursesAssigment;
use App\Models\CoursesCategory;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourseLivewire extends Component
{
    use WithFileUploads;

    public $selects = [
            'categories' => null,
            'assigments' => null,
        ], $course = [
            'name' => null,
            'description' => null,
            'image' => null,
        ], $relacion = [
            'category_id'  => null,
            'assigment_id' => null,
            'course_id'    => null
        ],
        $courseImage,
        $categories,
        $image,
        $categoriesSelected = [],
        $checks = [],
        $assigments,
        $assigmentsSelected = [],
        $assigmentsChecks = [],
        $courses,
        $categoryCourse,
        $course_id = 'create',
        $showText = false,
        $action = 'create';

    protected $rules = [
        'course.name' => 'required',
        'course.description' => 'required',
        'courseImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    public function mount()
    {
        # Selects
        $this->categories = Category::all();
        $this->assigments = Assigment::all();

        foreach ($this->categories as $key => $category) {
            $this->checks[$key] = false;
        }

        $this->loadCourses();
    }

    public function loadCourses()
    {
        # Cargar cursos
        $this->courses = Course::all();
    }

    public function showText()
    {
        $this->showText = true;
    }

    public function searchCategory($id)
    {
        return Category::where('id', $id)->first()->name;
    }

    public function getImage($url)
    {

        return Storage::url('../cursos-images/'.$url);
    }

    public function toCreate()
    {
        $this->validate();

        #Guarda en la bd cuando termine DB
        DB::beginTransaction();
        $this->courseImage->storeAs('cursos-images', $this->courseImage->getFilename());
        $this->course['image'] = $this->courseImage->getFilename();

        $course = Course::create($this->course);

        foreach ($this->categoriesSelected as $category) {
            if (isset($category)) {
                CoursesCategory::create([
                    'course_id' => $course->id,
                    'category_id' => $category,
                ]);
            }
        }

        foreach ($this->assigmentsSelected as $assigment) {
            if (isset($assigment)) {
                CoursesAssigment::create([
                    'course_id' => $course->id,
                    'assigment_id' => $assigment,
                ]);
            }
        }

        DB::commit();
        $this->reset(['course', 'categoriesSelected', 'assigmentsSelected']);
        $this->checks = [];
        $this->assigmentsChecks = [];
        $this->loadCourses();
        $this->image = !$this->image;
        //$this->edit($category->id);
    }

    protected function setDependencies($dep, $course)
    {
        # Configuramos los datos a manipular
        $rels = null;
        $check = [];
        $selected = [];

        # Condicionamos las dependencias
        switch ($dep) {
            case 'category':
                $dependences = $this->categories;
                $rels = $course->coursesCategories;
                break;
            case 'assigment':
                $dependences = $this->assigments;
                $rels = $course->coursesAssigments;
                break;
        }

        # Procesamos datos
        foreach ($dependences as $key => $dependence) {
            foreach ($rels as $item) {
                switch ($dep) {
                    case 'category':
                        $rel = $item->category_id;
                        break;
                    case 'assigment':
                        $rel = $item->assigment_id;
                        break;
                }

                if ($dependence->id == $rel) {
                    $check[$key] = true;
                    $selected[$key] = $rel;
                }
            }
        }
        # Condiciona antes de guardar datos
        switch ($dep) {
            case 'category':
                $this->checks = $check;
                $this->categoriesSelected = $selected;
                break;
            case 'assigment':
                $this->assigmentsChecks = $check;
                $this->assigmentsSelected = $selected;
                break;
        }
    }

    public function editCourse($id)
    {
        $this->action = 'update';
        $courseEdit = Course::find($id);
        $this->courseEdit = $courseEdit;
        $this->setDependencies('category', $courseEdit);
        $this->setDependencies('assigment', $courseEdit);

        $this->course['name'] = $courseEdit->name;
        $this->course['description'] = $courseEdit->description;

        //valido que name y description esten llenos
        /* $this->validate(['course.name' => 'required']); */
        /* dd($this->categoriesSelected); */
        //busco por id


        /*  foreach($this->categories as $key => $category)
        {
            //$courseCategory = CoursesCategory::where('category_id', $category->id)->first();
            $this->checks[$key] = false;
            $this->categoriesSelected[$key] = null;

            foreach($courseEdit->coursesCategories as $courseCategory)
            {
                if ($category->id == $courseCategory->category_id) {
                        $this->checks[$key] = true;
                        $this->categoriesSelected[$key] = $courseCategory->category_id;
                }
            }
        }

        foreach($this->assigments as $key => $assigment)
        {
            $this->assigmentsChecks[$key] = false;
            $this->assigmentsSelected[$key] = null;

            foreach($courseEdit->coursesAssigments as $courseAssigment)
            {
                if($assigment->id == $courseAssigment->assigment_id){
                    $this->assigmentsChecks[$key] = true;
                    $this->assigmentsSelected[$key] = $courseAssigment->assigment_id;
                }
            }
        }
            dd($this->assigmentsChecks,$this->assigmentsSelected); */


        //con el id encontrado actualizo name y description
        /* $courseEdit->update([
             'name'         => $this->name,
             'description'  => $this->description
         ]); */
    }

    public function update()
    {
        $this->validate();
        DB::beginTransaction();
        ## Actualiza el curso
        # Guarda la imagen en la local y le asigna el nombre
        $this->courseImage->storeAs('cursos-images', $this->courseImage->getFilename());
        # Guarda el nombre de la imagen en el contenedor de curso
        $this->course['image'] = $this->courseImage->getFilename();
        # Actualiza el curso con el contenedor
        $this->courseEdit->update($this->course);

       $test = [];
       #Preparar los selects de las categorias
        foreach($this->categoriesSelected as $key => $category){
            $found = $this->courseEdit->coursesCategories->where('category_id', $category)->first();
            if ($found) {
                if($this->checks[$key] == true){
                    $test[$key] = 'nada';
                } else{
                    $found->delete();
                }
            }else{
                if($this->checks[$key]){
                    CoursesCategory::create([
                        'course_id' => $this->courseEdit->id,
                        'category_id' => $category,
                    ]);
                        # Si no esta seleccionada ni marcado, la creo
                }
            }
        }

        $test3 = [];
        ## Prepara los selects de las asignaciones
        foreach ($this->assigmentsSelected as $key => $assigment) {
            $found = $this->courseEdit->coursesAssigments->where('assigment_id', $assigment)->first();
            if ($found) {
                if ($this->assigmentsChecks[$key] == true) {
                    $test3[$key] = 'nada'.$found; # Se queda como está

                } else {
                    $found->delete(); # Si no esta seleccionada, la borro
                }
            }else{
                if ($this->assigmentsChecks[$key] == true) {
                    CoursesAssigment::create([
                        'course_id' => $this->courseEdit->id,
                        'assigment_id' => $assigment,
                    ]);
                     # Si no esta seleccionada ni marcado, la creo
                }
            }
        }
        $found = null;

        DB::commit();
        $this->loadCourses();
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $assigmentDelete = CoursesAssigment::where('course_id', $id)->get();
        foreach ($assigmentDelete as $assigment) {
            $assigment->delete();
        }

        $categoryDelete = CoursesCategory::where('course_id', $id)->get();
        foreach ($categoryDelete as $category) {
            $category->delete();
        }

        $courseDelete = Course::find($id);
        Storage::disk('public')->delete($courseDelete->image);
        $courseDelete->delete();
        DB::commit();

        $this->loadCourses();
    }

    public function resetData()
    {
        $this->reset(['course', 'categoriesSelected', 'assigmentsSelected']);
    }

    public function selectedCategory($key, $id)
    {
        if ($this->checks[$key] == true) {
            $this->categoriesSelected[$key] = $id;
        } else {
            if ($this->action == 'create') {
                $this->categoriesSelected[$key] = null;
            }
        }
    }

    public function selectedAssigment($key, $id)
    {
        if ($this->assigmentsChecks[$key] == true) {
            $this->assigmentsSelected[$key] = $id;
        } else {
            if($this->action == 'create'){
                $this->assigmentsSelected[$key] = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.course-livewire');
    }
}
