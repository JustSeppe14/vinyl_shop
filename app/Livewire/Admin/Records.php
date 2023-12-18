<?php

namespace App\Livewire\Admin;

use App\Models\Genre;
use App\Models\Record;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\RecordForm;

class Records extends Component
{
    use WithPagination;
    // filter and pagination
    public $search;
    public $noStock = false;
    public $noCover = false;
    public $perPage = 5;
    // show/hide the modal
    public $showModal = true;
    public RecordForm $form;

    // reset the paginator
    public function updated($propertyName, $propertyValue)
    {
        // reset if the $search, $noCover, $noStock or $perPage property has changed (updated)
        if (in_array($propertyName, ['search', 'noCover', 'noStock', 'perPage']))
            $this->resetPage();
    }

    #[Layout('layouts.vinylshop', ['title' => 'Records', 'description' => 'Manage the records of your vinyl records',])]

    public function newRecord()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;


    }

    public function getDataFromMusicbrainzApi()
    {
        $this->form->getArtistRecord();
    }

    public function editRecord(Record $record)
    {
        $this->resetErrorBag();
        $this->form->fill($record);
        $this-> showModal = true;
    }


    public function render()
    {
        // filter by $search
        $query = Record::orderBy('artist')
            ->orderBy('title')
            ->searchTitleOrArtist($this->search);
        // only if $noCover is true, filter the query further, else, skip this step
        if ($this->noStock)
            $query->where('stock', false);
        // only if $noCover is true, filter the query further, else, skip this step
        if($this->noCover)
            $query->coverExists(false);
        // paginate the $query
        $records = $query
            ->paginate($this->perPage);
        // get the genres for the dropdown in the modal
        $genres = Genre::orderBy('name')->get();
        return view('livewire.admin.records', compact('records', 'genres'));
    }
}
