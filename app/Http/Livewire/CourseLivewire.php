<?php

namespace App\Http\Livewire;

use App\Models\Assigment;
use App\Models\Category;
use App\Models\Course;
use App\Models\File;
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
        'category_id' => null,
        'assigment_id' => null,
    ];

    protected $rules = [
        'course.name' => 'required',
        'course.description' => 'required',
        'course.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'course.category_id' => 'required',
        'course.assigment_id' => 'required'
    ];

    public function mount()
    {
        $this->selects['categories'] = Category::pluck('name', 'id');
        $this->selects['assigments'] = Assigment::pluck('name', 'id');
    }
    public function toCreate()
    {
        $this->course['image']->storeAs('courses-images', $this->course['image']->getFilename());

        $this->course['image'] = 'cursos-images/'.$this->course['image']->getFilename();


       $course = Course::create($this->course);

       dd($course);
       //$this->edit($category->id);
    }

    public function render()
    {
        return view('livewire.course-livewire');
    }
}
