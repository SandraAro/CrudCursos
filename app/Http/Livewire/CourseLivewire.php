<?php

namespace App\Http\Livewire;

use App\Models\Assigment;
use App\Models\Category;
use App\Models\Course;
use App\Models\CoursesAssigment;
use App\Models\CoursesCategory;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CourseLivewire extends Component
{
    use WithFileUploads;

    public $selects = [
        'categories' => null,
        'assigments' => null,
    ],$course = [
        'name' => null,
        'description' => null,
        'image' => null,
    ],$relacion = [
        'category_id'  => null,
        'assigment_id' => null,
        'course_id'    => null
    ],
    $categories,
    $categoriesSelected = [],
    $checks = [],
    $assigments,
    $assigmentsSelected = [],
    $assigmentsChecks = [];

    protected $rules = [
        'course.name' => 'required',
        'course.description' => 'required',
        'course.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    public function mount()
    {
        # Selects
        $this->categories = Category::all();
        $this->assigments = Assigment::all();

        # Cargar cursos
        $this->courses = Course::get();
    }

    public function toCreate()
    {
        #Guarda en la bd cuando termine DB
        DB::beginTransaction();
        $this->course['image']->storeAs('courses-images', $this->course['image']->getFilename());
        $this->course['image'] = 'cursos-images/'.$this->course['image']->getFilename();

        $course = Course::create($this->course);

        foreach ($this->categoriesSelected as $category) {
                CoursesCategory::create([
                    'course_id' => $course->id,
                    'category_id' => $category,
                ]);
        }

        foreach ($this->assigmentsSelected as $assigment) {
            CoursesAssigment::create([
                'course_id' => $course->id,
                'assigment_id' => $assigment,
            ]);
        }

        DB::commit();
       dd($this->course);
       //$this->edit($category->id);
    }

    public function selectedCategory($key, $id)
    {
       if ($this->checks[$key] == true) {
        $this->categoriesSelected[$key] = $id;
       }else{
        $this->categoriesSelected[$key] = null;
       }
    }

    public function selectedAssigment($key, $id)
    {
        if($this->assigmentsChecks[$key] == true){
            $this->assigmentsSelected[$key] = $id;
        }else{
            $this->assigmentsSelected[$key] = null;
        }
    }

    public function render()
    {
        return view('livewire.course-livewire');
    }
}
