<?php

namespace App\Livewire\Pages;

use App\Models\University;
use Livewire\Component;

class RegistrationPage extends Component
{
    public ?University $university;

    public function mount($university_id)
    {
        $this->university = University::query()->findOrFail($university_id);
    }

    protected function registrations()
    {
        return $this->university->registrations()
            ->orderBy('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.registration', [
            'registrations' => $this->registrations()
        ]);
    }
}
