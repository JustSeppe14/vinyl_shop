<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Livewire\Attributes\On;
use Storage;

class NavBar extends Component
{
    public $avatar;
    #[On('refresh-navigation-menu')]
    public function refreshNavBar()
    {
        $refresh = true;
    }
    public function render()
    {
        if (auth()->user()){
            $this->avatar = 'https://ui-avatars.com/api/?name=' .urlencode(auth()->user()->name);
            if (auth()->user()->profile_photo_path){
                if (Storage::disk('public')->exists(auth()->user()->profile_photo_path)){
                    $this->avatar = asset('storage/' . auth()->user()->profile_photo_path);
                }
            }
        }
        return view('livewire.layout.nav-bar');
    }
}
