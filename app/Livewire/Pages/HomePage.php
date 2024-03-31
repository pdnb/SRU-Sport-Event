<?php

namespace App\Livewire\Pages;

use App\Models\Registration;
use App\Models\Sport;
use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Mary\Traits\Toast;

class HomePage extends Component
{
    use Toast;

    public string $search = '';

    protected function universities()
    {
        return University::query()
            ->withCount('registrations')
            ->orderBy('name')
            ->get();
    }

    protected function registrations()
    {
        if(!$this->search)
        {
            return auth()->user()
                ->university
                ->registrations()
                ->orderBy('created_at')
                ->get();
        }

        return auth()->user()
            ->university
            ->registrations()
            ->where(function(Builder $query) {
                $query->orWhere('prefix', 'like', "%{$this->search}%")
                    ->orWhere('first_name', 'like', "%{$this->search}%")
                    ->orWhere('last_name', 'like', "%{$this->search}%");
            })
            ->orderBy('created_at')
            ->get();
    }

    public function render()
    {
        if(auth()->guest())
            return view('livewire.pages.guest', [
                'universities' => $this->universities()
            ]);

        return view('livewire.pages.home', [
            'registrations' => $this->registrations()
        ]);
    }

    public function delete($id)
    {
        Registration::query()
            ->findOrFail($id)
            ->delete();

        $this->success('ลบข้อมูลผู้สมัครสำเร็จ');
    }
}
