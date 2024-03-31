<div>
{{--    <x-stat title="ผู้สมัครแข่งขัน" value="{{ $universities->sum('registrations_count') }}" icon="o-users" />--}}

    @foreach($universities as $university)
        <x-list-item :item="$university">
            <x-slot:avatar>
                <x-icon name="o-building-library" class="text-primary" />
            </x-slot:avatar>
            <x-slot:value>
                {{ $university->name }}
            </x-slot:value>
            <x-slot:actions>
                <x-button icon="o-user" class="btn-circle relative" :link="route('registrations', ['university_id' => $university->id])" tooltip="รายชื่อผู้สมัครแข่งขัน">
                    <x-badge value="{{ $university->registrations_count }}" class="badge-sm badge-error text-white absolute -right-1 -top-1" />
                </x-button>
            </x-slot:actions>
        </x-list-item>
    @endforeach
</div>
