<div>
{{--    <x-stat title="ผู้สมัครแข่งขัน" value="{{ $universities->sum('registrations_count') }}" icon="o-users" />--}}
    <x-alert title="คำชี้แจง" icon="o-exclamation-circle" class="alert-warning">
        <x-slot:description>
            <div class="text-sm">ท่าสามารถเข้าสู่ระบบด้วยอีเมล์มหาวิทยาลัยของท่าน เพื่อสมัครเข้าร่วมการแข่งขันได้</div>
        </x-slot:description>
    </x-alert>

    <x-button no-wire-navigate class="lg:hidden btn-primary mt-2 btn-block" link="/auth/login" icon="o-arrow-right-end-on-rectangle">เข้าสู่ระบบด้วย Google</x-button>

    @foreach($universities as $university)
        <x-list-item :item="$university" :link="route('registrations', ['university_id' => $university->id])" class="mt-4">
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
