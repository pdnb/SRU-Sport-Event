<?php

namespace App\Livewire\Forms;

use App\Models\Registration;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class RegisterForm extends Form
{
    use WithFileUploads;

    #[Validate(rule: 'required', message: 'กรุณาระบุคำนำหน้า')]
    public string $prefix;

    #[Validate(rule: 'required', message: 'กรุณาระบุชื่อ')]
    public string $first_name;

    #[Validate('required', message: 'กรุณาระบุนามสกุล')]
    public string $last_name;

    #[Validate('required', message: 'กรุณาระบุอายุ')]
    public string $age;

//    #[Validate('required', message: 'กรุณาระบุชนิดกีฬาที่สมัครแข่งขัน')]
    public array $sports = [];

    public array $positions = [];

    #[Validate('required', message: 'กรุณาอัพโหลดรูปถ่ายขนาด 1 - 2 นิ้ว')]
    #[Validate('image', message: 'กรุณาอัพโหลดไฟล์รูปภาพ')]
    #[Validate('max:10240', message: 'กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 10 MB.')]
    public $photo;

    #[Validate('required', message: 'กรุณาอัพโหลดสำเนาบัตรประจำตัวประชาชน')]
    #[Validate('mimes:pdf', message: 'กรุณาอัพโลหดไฟล์ PDF')]
    #[Validate('max:10240', message: 'กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 10 MB.')]
    public $id_card;

    #[Validate('required', message: 'กรุณาอัพโหลดสำเนาบัตรประจำตัวพนักงาน หรือสัญญาจ้าง หรือคำสั่งจ้าง')]
    #[Validate('mimes:pdf', message: 'กรุณาอัพโลหดไฟล์ PDF')]
    #[Validate('max:10240', message: 'กรุณาอัพโหลดไฟล์ขนาดไม่เกิน 10 MB.')]
    public $staff_card;

    public function store()
    {
        $registration = Registration::query()->create([
            'university_id' => auth()->user()->university_id,
            'prefix' => $this->prefix,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'photo' => $this->photo->store('photo') ?? '',
            'id_card' => $this->id_card->store('id_card') ?? '',
            'staff_card' => $this->staff_card->store('staff_card') ?? '',
            'created_by' => auth()->id()
        ]);

        if($this->sports)
            $registration->sports()->sync($this->sports);

        if($this->positions)
            $registration->positions()->sync($this->positions);
    }
}
