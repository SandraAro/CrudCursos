<?php

namespace App\Http\Livewire;

use App\Models\Assigment;
use Livewire\Component;

class AssigmentLivewire extends Component
{
    public $name;

    /* protected $rules = [
        'name' => 'required',
    ]; */

    public function toCreate()
    {
       $this->validate(['name' => 'required']);

       $assigment = Assigment::create([
            'name' => $this->name
       ]);

       dd($assigment);
       //$this->edit($category->id);
    }

    public function render()
    {
        return view('livewire.assigment-livewire');
    }
}
