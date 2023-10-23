<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Record;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Demo extends Component
{
    #[Layout('layouts.vinylshop',[
        'title'=> 'Eloquent models',
        'subtitle' => 'Eloquent models: part 2',
        'description'=> 'Eloquent models: part 2'
    ])]
    public function render()
    {
        $records = Record::orderBy('artist')
//            ->with('genre')
            ->get();

        $genres = Genre::orderBy('name')
            ->with('records')
            ->has('records')
            ->get();

        return view('livewire.demo',compact('records','genres'));
    }
}
