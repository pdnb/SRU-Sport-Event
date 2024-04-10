<div>
    <div class="breadcrumbs text-lg">
        <ul>
            <li>รายชื่อผู้สมัครแข่งขัน</li>
            <li>{{ $university->name }}</li>
        </ul>
    </div>
    @forelse($registrations as $registration)
        <x-list-item :item="$registration" value="fullname">
            <x-slot:avatar>
                <x-icon name="o-user" />
            </x-slot:avatar>
            <x-slot:sub-value>
                <small>
                    <x-icon name="o-clock" /> {{ $registration->created_at->since() }}
                </small>
            </x-slot:sub-value>
        </x-list-item>
    @empty
        <div class="text-center mt-4">
            <x-icon name="o-x-circle" class="w-8 h-8 text-error" />
            <br />
            <span class="text-gray-400 mt-1">ไม่พบข้อมูล</span>
        </div>
    @endforelse
</div>
