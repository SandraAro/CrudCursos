<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Curso extends Component
{
    use WithFileUploads;

    public $archivo, $title;

    public function submit()
    {
        #Validacion
        $validatedData = $this->validate([
            'title' => 'required',
            'archivo'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->archivo->storeAs('public', $this->archivo->getFilename());

        File::create([
            'title' => $this->title,
            'name' => 'public/'.$this->archivo->getFilename(),
        ]);

        session()->flash('message', 'Imagen subida con exito!');
        $this->emitTo('list-file', 'getFiles');
    }

    public function render()
    {
        return view('livewire.curso');
    }
}
