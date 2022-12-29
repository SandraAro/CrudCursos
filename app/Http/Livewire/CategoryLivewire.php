<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryLivewire extends Component
{
    public $name;

    /* protected $rules = [
        'name' => 'required',
    ]; */

    public function toCreate()
    {
       $this->validate(['name' => 'required']);

       $category = Category::create([
            'name' => $this->name
       ]);

       dd($category);
       //$this->edit($category->id);
    }

    public function render()
    {
        return view('livewire.category-livewire');
    }
}
