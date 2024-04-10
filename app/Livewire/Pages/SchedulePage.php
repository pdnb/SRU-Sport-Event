<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Title;

class SchedulePage extends Component
{
    public string $googleDriveFileId = '';

    public function mount($id)
    {
        $this->googleDriveFileId = $id;
    }

    #[Title('โปรแกรมการแข่งขัน')]
    public function render()
    {
        return view('livewire.pages.schedule');
    }
}
