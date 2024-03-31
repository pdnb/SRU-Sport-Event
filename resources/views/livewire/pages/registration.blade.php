<div>
    <div class="breadcrumbs text-lg">
        <ul>
            <li>รายชื่อผู้สมัครแข่งขัน</li>
            <li>{{ $university->name }}</li>
        </ul>
    </div>
    @foreach($registrations as $registration)
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
    @endforeach
</div>
