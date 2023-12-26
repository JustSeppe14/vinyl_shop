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
    public $showModal = false;
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
        $this->validateOnly('form.mb_id');
        $this->form->getArtistRecord();
    }

    public function createRecord()
    {
        $this->form->create();
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$this->form->title}</i></b> has been added",
            'icon' => 'success',
        ]);
    }
    public function editRecord(Record $record)
    {
        $this->resetErrorBag();
        $this->form->fill($record);
        $this->showModal = true;
    }

    public function updateRecord(Record $record)
    {
        $this->form->update($record);
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$this->form->title}</i></b> from <b><i>{$this->form->artist}</i></b> has been updated",
            'icon' => 'success',
        ]);
    }
    public function deleteRecord(Record $record)
    {
        $this->form->delete($record);
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The record <b><i>{$record->title}</i></b> from <b><i>{$record->artist}</i></b> has been deleted",
            'icon' => 'success',
        ]);
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
