<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Genres2 extends Component
{
    public $orderBy = 'name';
    public $oderAsc = true;

    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->oderAsc = !$this->oderAsc :
            $this->oderAsc = true;
        $this->orderBy = $column;
    }

    #[Layout('layouts.vinylshop',['title'=>'Genres','description'=>'Manage the genres of your vinyl records',])]
    public function render()
    {
        $genres = Genre::withCount('records')
            ->orderBy($this->orderBy, $this->oderAsc ? 'asc' : 'desc')
            ->get();
        return view('livewire.admin.genres2',compact('genres'));
    }
}
