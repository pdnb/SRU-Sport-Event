<div>
    <x-form wire:submit="save" class="">
        <x-input
            label="คำนำหน้า"
            wire:model="form.prefix"
        />

        <x-input
            label="ชื่อ"
            wire:model="form.first_name"
        />

        <x-input
            label="นามสกุล"
            wire:model="form.last_name"
        />

        <x-input
            label="อายุ"
            wire:model="form.age"
            type="number"
            suffix="ปี"
        />

        <x-choices
            label="ชนิดกีฬาที่สมัครแข่งขัน"
            wire:model="form.sports"
            :options="$sports"
            option-label="name"
            hint="เลือกได้มากกว่า 1 ชนิดกีฬา"
        />

        <x-choices
            label="ตำแหน่งอื่น"
            wire:model="form.positions"
            :options="$positions"
            option-label="name"
            hint="เลือกได้มากกว่า 1 ตำแหน่ง"
        />

        <x-file
            label="รูปถ่ายขนาด 1 - 2 นิ้ว"
            wire:model="form.photo"
            accept="image/png, image/jpeg"
            hint="รองรับไฟล์รูปภาพไม่เกิน 10 MB."
        />

        <x-file
            label="สำเนาบัตรประจำตัวประชาชน"
            wire:model="form.id_card"
            accept="application/pdf"
            hint="รองรับไฟล์ PDF ไม่เกิน 10 MB."
        />

        <x-file
            label="สำเนาบัตรประจำตัวพนักงาน หรือสัญญาจ้าง หรือคำสั่งจ้าง"
            wire:model="form.staff_card"
            accept="application/pdf"
            hint="รองรับไฟล์ PDF ไม่เกิน 10 MB."
        />

        <x-slot:actions>
            <x-button
                label="ตรวจสอบข้อมูล"
                type="submit"
                class="btn-primary"
                icon="o-check-circle"
                spinner="save"
            />

            <x-button
                label="ยกเลิก"
                icon="o-x-circle"
                wire:click="cancel()"
                wire:confirm="ต้องการยกเลิกการสมัครใช่หรือไม่?"
            />
        </x-slot:actions>
    </x-form>

    <x-modal wire:model="confirmModal" title="ยืนยันข้อมูลการสมัคร" subtitle="โปรดตรวจสอบข้อมูลให้ถูกต้อง และกดยืนยันการสมัคร">
        <label class="input input-bordered flex items-center gap-2 mb-2">
            คำนำหน้า
            <input type="text" class="grow" value="{{ $form ->prefix ?? '' }}" readonly />
        </label>

        <label class="input input-bordered flex items-center gap-2 mb-2">
            ชื่อ
            <input type="text" class="grow" value="{{ $form ->first_name ?? '' }}" readonly />
        </label>

        <label class="input input-bordered flex items-center gap-2 mb-2">
            นามสกุล
            <input type="text" class="grow" value="{{ $form ->last_name ?? '' }}" readonly />
        </label>

        <label class="input input-bordered flex items-center gap-2 mb-2">
            อายุ
            <input type="text" class="grow" value="{{ $form ->age ?? '' }}" readonly />
            <span>ปี</span>
        </label>

        <label class="gap-2 mb-2">
            ชนิดกีฬาที่สมัครแข่งขัน
        </label>

        <div>
            @forelse($sports->whereIn('id', $form->sports)->all() as $sport)
                <span class="badge badge-success text-white mb-1">{{ $sport->name }}</span>
            @empty
                <p>-</p>
            @endforelse
        </div>

        <label class="gap-2 mb-2">
            ตำแหน่งอื่น
        </label>

        <div>
            @forelse($positions->whereIn('id', $form->positions)->all() as $position)
                <div class="badge badge-success text-white mb-1">{{ $position->name }}</div>
            @empty
                <p>-</p>
            @endforelse
        </div>

        <label class="gap-2 mb-2">
            รูปถ่ายขนาด 1 - 2 นิ้ว
        </label>

        <div class="flex justify-center">
            @if($form->photo)
                <img class="max-h-60" src="{{ $form->photo->temporaryUrl() ?? '' }}" />
            @endif
        </div>

        <label class="gap-2 mb-2">
            สำเนาบัตรประจำตัวประชาชน
        </label>

        <div class="mb-2">
            @if($form->id_card)
                <x-button label="ดาวน์โหลด" link="{{ $form->id_card->temporaryUrl() }}" external icon="o-arrow-down-tray" class="btn-sm" />
            @endif
        </div>

        <label class="gap-2 mb-2">
            สำเนาบัตรประจำตัวพนักงาน หรือสัญญาจ้าง หรือคำสั่งจ้าง
        </label>

        <div class="mb-2">
            @if($form->staff_card)
                <x-button label="ดาวน์โหลด" link="{{ $form->staff_card->temporaryUrl() }}" external icon="o-arrow-down-tray" class="btn-sm" />
            @endif
        </div>

        <x-slot:actions>
            <x-button label="ยืนยันการสมัคร" wire:click="confirm()" class="btn-primary" icon="o-check-circle" />
            <x-button label="กลับไปแก้ไข" @click="$wire.confirmModal = false" icon="o-x-circle" />
        </x-slot:actions>
    </x-modal>
</div>
