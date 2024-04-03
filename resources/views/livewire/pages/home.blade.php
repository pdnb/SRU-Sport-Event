<div>
    <x-header class="mb-6">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-magnifying-glass" wire:model.live.debounce.500ms="search" autocomplete="off" clearable />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-user-plus" class="btn-primary" label="สมัครเข้าร่วมแข่งขัน" :link="route('register')" />
        </x-slot:actions>
    </x-header>
    <x-alert title="คำชี้แจง" description="หากท่านต้องการแก้ไขข้อมูลที่บันทึกไปแล้ว ให้ท่านลบข้อมูลเก่าและเพิ่มข้อมูลใหม่ที่ถูกต้อง" icon="o-exclamation-circle" class="alert-info" />
    @forelse($registrations as $registration)
        <x-list-item :item="$registration">
            <x-slot:avatar>
                <x-icon name="o-user" class="w-8 h-8 text-primary" />
            </x-slot:avatar>
            <x-slot:value>
                {{ $registration->fullname }}
            </x-slot:value>
            <x-slot:sub-value>
                <div class="mb-1">อายุ {{ $registration->age }} ปี</div>
                <div class="mb-1">
                    ชนิดกีฬา
                    @foreach($registration->sports as $sport)
                        <span class="badge badge-sm badge-success text-white">{{ $sport->name }}</span>
                    @endforeach
                </div>
                <div>
                    ตำแหน่งอื่น
                    @foreach($registration->positions as $position)
                        <span class="badge badge-sm badge-success text-white">{{ $position->name }}</span>
                    @endforeach
                </div>
            </x-slot:sub-value>
            <x-slot:actions>
                @if($registration->created_by == auth()->id())
                    <x-button icon="o-trash" class="text-red-500" wire:click="delete('{{ $registration->id }}')" wire:confirm="ยืนยันการลบข้อมูล {{ $registration->fullname }}" spinner />
                @endif
            </x-slot:actions>
        </x-list-item>
    @empty
        <div class="text-center">
            <x-icon name="o-x-circle" class="w-8 h-8 text-error" />
            <br />
            <span class="text-gray-400 mt-1">ไม่พบข้อมูล</span>
        </div>
    @endforelse
</div>
