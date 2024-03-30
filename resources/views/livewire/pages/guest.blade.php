<div>
    @foreach($universities as $university)
        <x-list-item :item="$university">
            <x-slot:avatar>
                <x-icon name="o-building-library" class="text-primary" />
            </x-slot:avatar>
            <x-slot:value>
                {{ $university->name }}
            </x-slot:value>
        </x-list-item>
    @endforeach
</div>
