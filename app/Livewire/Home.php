<?php

namespace App\Livewire;

use App\Models\Sport;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;

    public function render()
    {
        if(auth()->guest())
            return view('livewire.guest');

        $sports = Sport::query()
            ->orderBy('name')
            ->get();

        return view('livewire.home', [
            'sports' => $sports
        ]);
    }
}
