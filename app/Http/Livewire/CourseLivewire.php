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
    $assigmentsChecks = [],
    $courses,
    $categoryCourse;

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


        $this->loadCourses();
    }

    public function loadCourses(){
        # Cargar cursos
        $this->courses = Course::all();
        $this->categoryCourse = CoursesCategory::all();
    }

    public function searchCategory($id)
    {
        return Category::where('id', $id)->first()->name;
    }
    public function getImage($url)
    {
        return Storage::url($url);
    }

    public function toCreate()
    {
        #Guarda en la bd cuando termine DB
        DB::beginTransaction();
        $this->course['image']->storeAs('public', $this->course['image']->getFilename());
        $this->course['image'] = $this->course['image']->getFilename();

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
        $this->loadCourses();
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

    public function showCategory()
    {
        /* $data = DB::table('categories')
        ->join ('courses_categories', 'courses_categories.category_id', '=',  'categories.id')
        ->select('categories.name as nameCategory')
        ->get(); */
        //$data = Category::with('category.name')->get();

        /* dd($data); */
    }

    public function render()
    {
        return view('livewire.course-livewire');
    }
}
