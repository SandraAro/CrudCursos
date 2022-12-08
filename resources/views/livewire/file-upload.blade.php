<div>
    <div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="form-group">
        <label>Titulo:</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror"  placeholder="Introduzca el titulo" wire:model="title">
        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label>Archivo:</label>
        <input type="file" class="form-control @error('archivo') is-invalid @enderror" wire:model="archivo">
        @error('archivo')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <br>
    <button wire:click="submit" class="btn btn-success">Guardar</button>
</div>
