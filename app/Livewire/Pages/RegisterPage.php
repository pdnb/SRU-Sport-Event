<?php

namespace App\Livewire\Pages;

use App\Livewire\Forms\RegisterForm;
use App\Models\Position;
use App\Models\Sport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Mary\Traits\Toast;

class RegisterPage extends Component
{
    use WithFileUploads, Toast;

    public RegisterForm $form;
    public $confirmModal;

    protected function sports()
    {
        return Sport::query()
            ->orderBy('created_at')
            ->get();
    }

    protected function positions()
    {
        return Position::query()
            ->orderBy('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.register', [
            'sports' => $this->sports(),
            'positions' => $this->positions()
        ]);
    }

    public function save()
    {
        $this->form->validate();

        $this->confirmModal = true;
    }

    public function confirm()
    {
        $this->form->store();

        $this->confirmModal = false;

        $this->success('บันทึกข้อมูลการสมัครสำเร็จ', redirectTo: route('home'));
    }

    public function cancel()
    {
        $this->redirect(route('home'));
    }
}
