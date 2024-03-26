<div>
    @foreach($sports as $sport)
        <x-list-item :item="$sport" link="/apply">
            <x-slot:actions>
                <x-button icon="o-pencil-square" class="text-primary" label="ลงทะเบียน" spinner />
            </x-slot:actions>
        </x-list-item>
    @endforeach
</div>
