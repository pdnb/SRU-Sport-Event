<div>
{{--    <x-stat title="ผู้สมัครแข่งขัน" value="{{ $universities->sum('registrations_count') }}" icon="o-users" />--}}
    <x-alert title="คำชี้แจง" description="ท่าสามารถเข้าสู่ระบบด้วยอีเมล์มหาวิทยาลัยของท่าน เพื่อสมัครเข้าร่วมการแข่งขันได้" icon="o-exclamation-circle" class="alert-info" />

    @foreach($universities as $university)
        <x-list-item :item="$university" :link="route('registrations', ['university_id' => $university->id])">
            <x-slot:avatar>
                <x-icon name="o-building-library" class="text-primary" />
            </x-slot:avatar>
            <x-slot:value>
                {{ $university->name }}
            </x-slot:value>
            <x-slot:actions>
                <x-button icon="o-user" class="btn-circle relative" tooltip="รายชื่อผู้สมัครแข่งขัน">
                    <x-badge value="{{ $university->registrations_count }}" class="badge-sm badge-error text-white absolute -right-1 -top-1" />
                </x-button>
            </x-slot:actions>
        </x-list-item>
    @endforeach
</div>
