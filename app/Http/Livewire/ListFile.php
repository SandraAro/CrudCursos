<?php

namespace App\Http\Livewire;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ListFile extends Component
{
    public $cursos;
    protected $listeners = ['getFiles'];

    public function mount()
    {
        $this->getFiles();
    }

    public function getFiles(){
        $this->cursos = File::where('id', '<', '6')->get();
    }
    public function getImage($url)
    {
        return Storage::url($url);
    }
    public function render()
    {
        return view('livewire.list-file');
    }
}
