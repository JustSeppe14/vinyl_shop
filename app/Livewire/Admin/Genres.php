<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Genres extends Component
{
    //sort properties
    public $orderBy = 'name';
    public $orderAsc = true;

    public $perPage = 10;

    #[Validate('required|min:3|max:30|unique:genres,name',attribute: 'name for this genre',)]
    public $newGenre;

    #[Validate([
        'editGenre.name' => 'required|min:3|max:30|unique:genres,name',
    ], as: [
        'editGenre.name' => 'name for this genre',
    ])]
    public $editGenre = ['id'=>null, 'name'=>null];

    public function resetValues()
    {
        $this->reset('newGenre','editGenre');
        $this->resetErrorBag();
    }

    public function edit(Genre $genre)
    {
        $this->editGenre = [
            'id' => $genre->id,
            'name' => $genre->name,
        ];
    }

    public function update(Genre $genre)
    {
        $this->editGenre['name'] = trim($this->editGenre['name']);
        //als de naam niet is veranderd, doe je niks
        if (strtolower($this->editGenre['name']) === strtolower($genre->name)){
            $this->resetValues();
            return;
        }
        $this->validateOnly('editGenre.name');
        $oldName = $genre->name;
        $genre->update([
            'name'=>trim($this->editGenre['name']),
        ]);
        $this->resetValues();
        $this->dispatch('swal:toast',[
            'background'=>'success',
            'html'=>"The genre <b><i>{$oldName}</i></b> has been updated to <b><i>{$genre->name}</i></b>",
        ]);

    }

    public function create()
    {
        //validate the new genre name
        $this -> validateOnly('newGenre');
        //create the genre
        $genre = Genre::create([
            'name' => trim($this->newGenre),
        ]);
        $this->resetValues();
        //toast
        $this->dispatch('swal:toast',[
            'background'=>'success',
            'html'=>"The genre <b><i>{$genre->name}</i></b> has been added",
        ]);
    }
    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->orderAsc = !$this->orderAsc :
            $this->orderAsc = true;
        $this->orderBy = $column;
    }
    #[On('delete-genre')]
    public function delete($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The genre <b><i>{$genre->name}</i></b> has been deleted",
        ]);
    }

    #[Layout('layouts.vinylshop',['title'=>'Genres','description'=>'Manage the genres of your vinyl records',])]
    public function render()
    {
        $genres = Genre::withCount('records')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.admin.genres',compact('genres'));
    }
}
