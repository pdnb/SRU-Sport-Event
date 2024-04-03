{{-- MENU --}}
<x-menu activate-by-route>

    {{-- User --}}
    @if($user = auth()->user())
        <x-menu-separator />

        <x-list-item :item="$user" value="name" sub-value="university.name" avatar="auth0.picture" no-separator no-hover class="-mx-2 !-my-2 rounded">
            <x-slot:actions>
                <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="ออกจากระบบ" onCLick="logoutModal.showModal(); return false;" />
            </x-slot:actions>
        </x-list-item>

        <x-menu-separator />

        <x-menu-item title="หน้าหลัก" icon="o-home" link="/" />
        <x-menu-item title="สมัครเข้าร่วมแข่งขัน" icon="o-user-plus" link="/register" />
    @else
        <x-menu-separator />
        <x-button no-wire-navigate class="btn-primary" link="/auth/login" icon="o-arrow-right-end-on-rectangle">เข้าสู่ระบบด้วย Google</x-button>
        <x-menu-separator />

        <x-menu-item title="หน้าหลัก" icon="o-home" link="/" />
    @endif

</x-menu>
