<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{   public $texto = "Hola";

    public function holaTexto()
    {
       $this->texto = "adios";
    }
    public function render()
    {
        return view('livewire.test');
    }
}
