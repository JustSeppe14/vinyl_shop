<?php

namespace App\Livewire;


use Http;
use Livewire\Component;

class Quote extends Component
{
    public $quote = 'lmjfmlsjdflsdj';
    public function render()
    {
        // https://api.quotable.io/random
        $result = Http::get('https://api.quotable.io/random')->json();
        $this->quote = $result['content'];
        return view('livewire.quote');
    }
}
