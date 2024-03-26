{{-- MENU --}}
<x-menu activate-by-route>

    {{-- User --}}
    @if($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="university.name" avatar="auth0.picture" no-separator no-hover class="-mx-2 !-my-2 rounded">
            <x-slot:actions>
                <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="อกกจากระบบ" onCLick="logoutModal.showModal(); return false;" />
            </x-slot:actions>
        </x-list-item>

        <x-menu-separator />

        <x-menu-item title="หน้าหลัก" icon="o-home" link="/" />
{{--        <x-menu-sub title="Settings" icon="o-cog-6-tooth">--}}
{{--            <x-menu-item title="Wifi" icon="o-wifi" link="####" />--}}
{{--            <x-menu-item title="Archives" icon="o-archive-box" link="####" />--}}
{{--        </x-menu-sub>--}}
    @else
        <x-menu-separator />
        <x-button no-wire-navigate class="btn-primary" link="/auth/login" icon="o-arrow-right-end-on-rectangle">เข้าสู่ระบบ</x-button>
        <x-menu-separator />
    @endif

</x-menu>
