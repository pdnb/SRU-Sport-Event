<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class ScorePage extends Component
{
    #[Title('ผลการแข่งขัน')]
    public function render()
    {
        return view('livewire.pages.score');
    }
}
