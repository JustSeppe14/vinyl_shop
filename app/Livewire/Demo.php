<?php

namespace App\Livewire;

use App\Models\Genre;
use App\Models\Record;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Demo extends Component
{
    public $zoek = 'the';
    public $perPage = 4;
    use WithPagination;
    #[Layout('layouts.vinylshop',[
        'title'=> 'Eloquent models',
        'subtitle' => 'Eloquent models: part 2',
        'description'=> 'Eloquent models: part 2'
    ])]
    public function render()
    {
        $maxPrice = 20;
        $q = '%' . $this->zoek . '%';
        $records = Record::orderBy('artist')
            ->orderBy('title')
            ->where('title','like',$q)
            // ->maxPrice($maxPrice)
            ->paginate($this->perPage);

        $genres = Genre::orderBy('name')
            ->with('records')
            ->has('records')
            ->get();
//        $genres = Genre::get();
        return view('livewire.demo',compact('records','genres'));
    }
}
